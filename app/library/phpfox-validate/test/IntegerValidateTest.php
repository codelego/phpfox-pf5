<?php

namespace Phpfox\Validate;

class IntegerValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testValue()
    {
        $obj = new IntegerValidate([]);
        $this->assertTrue($obj->isValid('123456'));
        $this->assertFalse($obj->isValid('123456dd'));
        $this->assertTrue($obj->isValid(4544));
        $this->assertTrue($obj->isValid(0));
        $this->assertFalse($obj->isValid(null));
    }
}
