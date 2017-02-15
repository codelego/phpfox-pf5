<?php

namespace Phpfox\Validate;


class RequiredValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new RequiredValidate([
            'message' => 'This field is required',
        ]);

        $this->assertFalse($obj->isValid(null));
        $this->assertEquals('This field is required', $obj->getError());
        $this->assertFalse($obj->isValid(''));
        $this->assertEquals('This field is required', $obj->getError());
        $this->assertTrue($obj->isValid('0'));
        $this->assertTrue($obj->isValid('1'));
        $this->assertTrue($obj->isValid(0));
        $this->assertTrue($obj->isValid(1));
        $this->assertTrue($obj->isValid([]));
    }
}
