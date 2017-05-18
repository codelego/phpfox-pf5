<?php

namespace Phpfox\Form;


class ElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {

        $attributes = [
            'maxlength'   => '200',
            'placeholder' => 'input name label',
            'noLabel'     => false,
            'noWrap'      => false,
        ];

        $params = [
            'param1' => 'value1',
            'param2' => 'value2',
        ];

        $obj = new Element([
            'name'       => 'input_name',
            'label'      => 'input label',
            'example'    => 'example-value',
            'required'   => true,
            'attributes' => $attributes,
            'params'     => $params,
        ]);

        $this->assertEquals('input_name', $obj->getName());
        $this->assertEquals('input label', $obj->getLabel());
        $this->assertTrue($obj->isRequired());
        $this->assertNull($obj->getAttribute('data-toggle'));
        $this->assertEquals($attributes, $obj->getAttributes());
        $this->assertTrue($obj->hasAttribute('maxlength'));
        $this->assertFalse($obj->hasAttribute('pattern'));
        $this->assertEquals([
            'param1'  => 'value1',
            'param2'  => 'value2',
            'example' => 'example-value',
            'label'=> 'input label',
        ], $obj->getParams());
        $this->assertNull($obj->getParam('param3'));
        $this->assertEquals('example-value', $obj->getParam('example'));
        $this->assertEquals('value3', $obj->getParam('param3', 'value3'));
        $this->assertNull($obj->getParam('param3'));

        $obj->setAttribute('maxlength', '100');
        $this->assertEquals(100, $obj->getAttribute('maxlength'));
        $this->assertFalse($obj->noLabel());
        $this->assertFalse($obj->noWrap());
        $this->assertEquals('text', $obj->getDecorator());
        $obj->setDecorator('input');
        $this->assertEquals('input', $obj->getDecorator());

        $this->assertNull($obj->getParent());

        $parent = new \stdClass();
        $obj->setParent($parent);
        $this->assertEquals($parent, $obj->getParent());
    }
}
