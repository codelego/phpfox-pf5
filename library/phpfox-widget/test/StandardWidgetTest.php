<?php

namespace Phpfox\Widget;

class MockExampleWidget extends StandardWidget
{

}


class StandardWidgetTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $params = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $obj = new MockExampleWidget($params);

        $this->assertEquals($params, $obj->getParams());

        $this->assertEquals('value1', $obj->getParam('key1'));
        $this->assertEquals('value2', $obj->getParam('key2'));
        $this->assertEquals(null, $obj->getParam('key3'));
        $this->assertEquals('value3', $obj->getParam('key3', 'value3'));

        $obj->setParam('key3', 'value3');
        $this->assertEquals('value3', $obj->getParam('key3'));

        $params2 = [
            'key1' => 'value1.',
            'key4' => 'value4',
        ];


        $obj->setParams($params2);
        $this->assertEquals('value1.', $obj->getParam('key1'));
        $this->assertEquals('value4', $obj->getParam('key4'));

        $this->assertEquals(false, $obj->run());
    }
}
