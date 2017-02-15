<?php

namespace Phpfox\Validate;


class ValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new Validate([
            'key'     => 'value',
            'value'   => 'example value',
            'message' => 'example message',
            'skip'    => true,
            'skipAll' => false,
        ]);

        $this->assertSame('example value', $obj->getValue());
        $this->assertSame('example message', $obj->getMessage());
        $this->assertSame(true, $obj->isValid(null));
        $this->assertSame('example message', $obj->getError());
        $this->assertSame(true, $obj->isSkip());
        $this->assertSame(false, $obj->isSkipAll());
    }

    public function testBase02()
    {
        $obj = new Validate();

        $obj->setValue('example value');
        $obj->setSkip(true);
        $obj->setSkipAll(false);
        $obj->setMessage('example message');

        $this->assertSame('example value', $obj->getValue());
        $this->assertSame('example message', $obj->getMessage());
        $this->assertSame(true, $obj->isValid(null));
        $this->assertSame('example message', $obj->getError());
        $this->assertSame(true, $obj->isSkip());
        $this->assertSame(false, $obj->isSkipAll());
    }


}
