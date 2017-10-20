<?php

namespace Phpfox\Form;


class CheckboxTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CheckboxField();

        $this->assertEmpty($obj->getName());
        $this->assertEmpty($obj->getValue());

        $obj->setName('input_name');
        $obj->setValue('input_value');

        $this->assertEquals('input_name', $obj->getName());
        $this->assertEquals('input_value', $obj->getValue());
        $this->assertTrue($obj->noLabel());
        $this->assertFalse($obj->isChecked());

        $obj->setParam('checkedValue', 'input_value');
        $this->assertTrue($obj->isChecked());

    }
}
