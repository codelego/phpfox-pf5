<?php

namespace Neutron\User\Auth;


class Pf5PasswordCompatibleTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Pf5PasswordCompatible();
        $static = '';
        $input = '123456';
        $salt  = 'OJ$';
        $hashed
            = 'd1398bddd6db7ac7040024d2ee4b0eecc4e86e0f';

        $this->assertEquals('d1398bddd6db7ac7040024d2ee4b0eecc4e86e0f',
            $obj->createHash($input, $salt, $static));

        $this->assertTrue($obj->isValid($input, $hashed, $salt, $static));
    }

    public function testHashed()
    {
        $obj = new Pf5PasswordCompatible();
        $this->assertEquals(4, strlen($obj->createSalt(4)));

    }
}
