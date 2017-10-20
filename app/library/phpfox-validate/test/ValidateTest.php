<?php

namespace Phpfox\Validate;


class ValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new Validate([
            'key'     => 'value',
            'message' => 'example message',
            'skip'    => true,
        ]);

        $this->assertSame(true, $obj->isValid(null));
        $this->assertSame('example message', $obj->get('message'));
        $this->assertSame(true, $obj->get('skip'));
    }

    public function testBase02()
    {
        $obj = new Validate();

        $obj->isValid('example value');
        $this->assertSame(true, $obj->isValid(null));
    }


}
