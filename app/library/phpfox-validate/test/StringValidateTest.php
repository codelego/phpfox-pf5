<?php

namespace Phpfox\Validate;


class StringValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new StringValidate([
            'message' => 'Invalid value',
            'max'     => 20,
        ]);
        $this->assertFalse($obj->isValid('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam'));
        $this->assertTrue($obj->isValid('lorem ispum'));
    }

    public function testMinLength()
    {
        $obj = new StringValidate([
            'message' => 'Invalid value',
            'min'     => 20,
        ]);
        $this->assertTrue($obj->isValid('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam'));
        $this->assertFalse($obj->isValid('lorem ispum'));
    }

    public function testRegexp()
    {
        $obj = new StringValidate([
            'message' => 'Invalid value',
            'regexp'  => '/^\d+$/i',
        ]);
        $this->assertTrue($obj->isValid('2334335435'));
        $this->assertFalse($obj->isValid('lorem ispum'));
    }
}
