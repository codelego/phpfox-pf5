<?php

namespace Phpfox\Validate;

class ValidateManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ValidateManager();

        $this->assertFalse($obj->has('example'));
        $this->assertTrue($obj->has('required'));

        $this->assertTrue($obj->make('', []) instanceof ValidateInterface);
        $this->assertTrue($obj->make('required', []) instanceof
            ValidateInterface);

        $obj->add('example', 'ValidateClassNotFoundExample');
        $this->assertTrue($obj->make('example', []) instanceof
            ValidateInterface);
    }
}
