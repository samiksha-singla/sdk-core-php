<?php
require_once 'PHPUnit/Framework.php';
require_once 'PPCertificateCredential.php';

/**
 * Test class for PPCertificateCredential.
 *
 */
class PPCertificateCredentialTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var PPCertificateCredential
	 */
	protected $credential;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->credential = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "1255077037", "cert_key.pem", "password");
		$this->credential->setApplicationId('APP-80W284485P519543T');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}

	/**@test
	 */
	public function testValidateUname()
	{
		$this->setExpectedException('PPMissingCredentialException');
		$credUname = new PPCertificateCredential("", "1255077037", "cert_key.pem", "password");
		$credUname->validate();
		$setNotExpectedException('PPMissingCredentialException');
		$credCorrect = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "1255077037", "cert_key.pem", "password");
		$var = $credCorrect->validate();
		$this->assertNull($var);
	}
	/**
	 * @test
	 */
	public function testValidatePwd()
	{
		$this->setExpectedException('PPMissingCredentialException');
		$credpwd = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "", "cert_key.pem", "password");
		$credpwd->validate();

	}
	/**
	 * @test
	 */
	public function testValidateCertPath()
	{
		$this->setExpectedException('PPMissingCredentialException');
		$credCertPath = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "1255077037", "", "dummypass");
		$credCertPath->validate();
	}
	/**
	 * @test
	 */
	public function testValidateCertPassphrase()
	{
		$this->setExpectedException('PPMissingCredentialException');
		$credCertPath = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "1255077037", "cert_key.pem", "");
		$credCertPath->validate();
	}
	/**
	 * @test
	 */
	public function testGetAppId()
	{
		$credAppid = new PPCertificateCredential("platfo_1255077030_biz_api1.gmail.com", "1255077037", "cert_key.pem", "dummypass");
		$credAppid->setApplicationId("APP-ID");
		$this->assertEquals($credAppid->getApplicationId(), "APP-ID");
	}

	/**
	 * @test
	 */
	public function testGetUserName()
	{
		$this->assertEquals('platfo_1255077030_biz_api1.gmail.com', $this->credential->getUserName());

	}

	/**
	 * @test
	 */
	public function testGetPassword()
	{
		$this->assertEquals('1255077037', $this->credential->getPassword());
	}

	/**
	 * @test
	 */
	public function testGetCertificatePath()
	{
		$this->assertStringEndsWith('cert_key.pem', $this->credential->getCertificatePath());
	}

	/**@test
	 */
	public function testGetApplicationId()
	{
		$this->assertEquals('APP-80W284485P519543T', $this->credential->getApplicationId());
	}
}
?>
