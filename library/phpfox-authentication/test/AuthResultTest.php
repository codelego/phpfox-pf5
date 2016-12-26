<?php

namespace Phpfox\Authentication;


class AuthResultTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::INVALID_CREDENTIAL);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::INVALID_CREDENTIAL, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    public function testBase2()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::INVALID_IDENTITY);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::INVALID_IDENTITY, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    public function testBase3()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::MISSING_CREDENTIAL);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::MISSING_CREDENTIAL, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    public function testBase4()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::MISSING_IDENTITY);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::MISSING_IDENTITY, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    public function testBase5()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::UN_CATEGORIZE);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::UN_CATEGORIZE, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBase6()
    {
        $obj = new AuthResult();

        $obj->setResult(100);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::UN_CATEGORIZE, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $this->assertEmpty($obj->getIdentity());
    }

    public function testBase7()
    {
        $obj = new AuthResult();

        $obj->setResult(AuthResult::SUCCESS);

        $this->assertFalse($obj->isValid());
        $this->assertEquals(AuthResult::SUCCESS, $obj->getCode());
        $this->assertNotEmpty($obj->getMessage());
        $obj->setIdentity(100);
        $this->assertEquals(100, $obj->getIdentity());
        $this->assertTrue($obj->isValid());
    }

}
