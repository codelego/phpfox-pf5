<?php

namespace Phpfox\Form;


class ButtonTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Button();

        $this->assertEmpty($obj->getName());
        $this->assertEmpty($obj->getValue());

        $obj->setName('input_name');
        $obj->setValue('input_value');

        $this->assertEquals('input_name', $obj->getName());
        $this->assertEquals('input_value', $obj->getValue());
        $this->assertTrue($obj->noLabel());

    }
}
