<?php

namespace Neutron\User\Auth;


class SePasswordCompatibleTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SePasswordCompatible();
        $static = '';
        $input = '123456';
        $salt = 'OJ$';
        $hashed
            = '5432795639c4524a29119d2f89aafc05';

        $this->assertEquals('5432795639c4524a29119d2f89aafc05',
            $obj->createHash($input, $salt, $static));

        $this->assertTrue($obj->isValid($input, $hashed, $salt, $static),
            $hashed);
    }

    public function testInvalid()
    {
        $obj = new SePasswordCompatible();
        $static = '';
        $input = '123456';
        $salt = 'OJ$';
        $hashed
            = '5432795639c4524a29119d2f89aafc05def';
        $this->assertFalse($obj->isValid($input, $hashed, $salt, $static),
            $hashed);

    }

    public function testHashed()
    {
        $obj = new SePasswordCompatible();
        $this->assertEquals(4, strlen($obj->createSalt(4)));

    }
}
