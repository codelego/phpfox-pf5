<?php

namespace Phpfox\Validate;


class CallbackValidateTest extends \PHPUnit_Framework_TestCase
{
    public function testClosure()
    {
        $obj = new CallbackValidate([
            'callable' => function ($value) {
                return $value === 'example_value';
            },
        ]);

        $this->assertTrue($obj->isValid('example_value'));
        $this->assertFalse($obj->isValid(''));
    }

    public function checkIsValid($value)
    {
        return $value == 'check_is_valid';
    }

    public function testCallback()
    {
        $obj = new CallbackValidate([
            'callable' => [$this, 'checkIsValid'],
        ]);

        $this->assertTrue($obj->isValid('check_is_valid'));
        $this->assertFalse($obj->isValid(''));
    }
}
