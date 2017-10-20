<?php

namespace Phpfox\Validate;


class IpValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testValid()
    {
        $obj = new IpValidate();

        $this->assertTrue($obj->isValid('127.123.11.133'));
        $this->assertTrue($obj->isValid('255.255.255.0'));
        $this->assertFalse($obj->isValid('523.255.255.0'));
        $this->assertFalse($obj->isValid('0.0.0.0.0'));
    }
}
