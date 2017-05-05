<?php

namespace Phpfox\Form;


class MultiChoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MultiSelectField();

        $this->assertEmpty($obj->getName());
        $this->assertEmpty($obj->getValue());

        $obj->setName('input_name');
        $obj->setValue('input_value');

        $this->assertEquals('input_name', $obj->getName());
        $this->assertEquals('input_value', $obj->getValue());

        $obj->setOptions(['key1' => 'value1', 'key2' => 'value2']);

        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'],
            $obj->getOptions());
    }
}
