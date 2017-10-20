<?php

namespace Neutron\User\Auth;

class Pf4PasswordCompatibleTest extends \PHPUnit_Framework_TestCase
{
    public function testNewMethodGenerator()
    {
        $obj = new Pf4PasswordCompatible();
        $static = '';
        $input = '123456';
        $salt = 'OJ$';
        $hashed
            = '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e';

        $this->assertEquals('165e3d5b8049a0b15c711ae46fc794c4',
            $obj->createHash($input, $salt, $static));

        $this->assertTrue($obj->isValid($input, $hashed, $salt, $static));
    }

    public function testOldPasswordGenerator()
    {
        $obj = new Pf4PasswordCompatible();
        $static = '';
        $input = '123456';
        $salt = 'OJ$';
        $hashed
            = '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2';

        $this->assertEquals('165e3d5b8049a0b15c711ae46fc794c4',
            $obj->createHash($input, $salt, $static));

        $this->assertFalse($obj->isValid($input, $hashed, $salt, $static));
    }

    public function testHashed()
    {
        $obj = new Pf4PasswordCompatible();
        $this->assertEquals(4, strlen($obj->createSalt(4)));

    }

}
