<?php

namespace Phpfox\Kernel;


class ParametersTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $params = new Parameters();

        $example_key = 'example_key';
        $example_value1 = 'example_value1';
        $example_value2 = 'example_value2';

        $this->assertNull($params->get($example_key));
        $params->delete($example_key);
        $this->assertNull($params->get($example_key));

        $params->set($example_key, $example_value1);
        $this->assertEquals($example_value1, $params->get($example_key));

        $params->set($example_key, $example_value2);
        $this->assertEquals($example_value2, $params->get($example_key));

        $params->delete($example_key);
        $this->assertNull($params->get($example_key));

        $params->add(['key1' => 'value1']);

        $this->assertEquals('value1', $params->get('key1'));

        $params->reset();

        $this->assertNull($params->get('key1'));
    }
}
