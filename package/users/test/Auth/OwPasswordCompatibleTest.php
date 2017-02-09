<?php

namespace Neutron\User\Auth;


class OwPasswordCompatibleTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new OwPasswordCompatible();
        $static = 'hEPIJiz1jOREboxI';
        $input = '123456';
        $hashed
            = '5e4c16066c13427fa5cae24e809f8262998916bffd7edc1b55af6f911f0f09f6';

        $this->assertEquals('5e4c16066c13427fa5cae24e809f8262998916bffd7edc1b55af6f911f0f09f6',
            $obj->createHash($input, '', $static));
        $this->assertTrue($obj->isValid($input, $hashed, '', $static));
    }

    public function testHashed()
    {
        $obj = new OwPasswordCompatible();
        $this->assertEquals(4, strlen($obj->createSalt(4)));

    }
}
