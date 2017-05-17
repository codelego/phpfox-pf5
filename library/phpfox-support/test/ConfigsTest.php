<?php

namespace Phpfox\Support;

use PHPUnit_Framework_TestCase;


class ConfigsTest extends PHPUnit_Framework_TestCase
{
    public function testConfigs()
    {
        $configs = new ParameterContainer();

        $this->assertEmpty($configs->getData());

        $configs->set('sample_key', 1);

        $this->assertEquals(1, $configs->get('sample_key'));

        $this->assertNotEquals(1, $configs->get('sample_key', 'section'));

        $this->assertNull($configs->get('there_no_key'));

        $configs->merge([
            'a' => 'b',
            'k' => ['k1' => 'k2', 'k3' => 'k4'],
        ]);

        $this->assertEquals('b', $configs->get('a'));
        $this->assertEquals(['k1' => 'k2', 'k3' => 'k4'], $configs->get('k'));

        $configs->merge([
            'a' => 'b1',
            'k' => ['k1' => 'k1-', 'k3' => 'k4-', 'k5' => 'abc'],
        ]);
    }
}
