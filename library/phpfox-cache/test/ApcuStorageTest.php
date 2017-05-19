<?php

namespace Phpfox\Cache;

/**
 * @requires extension apcu
 */
class ApcuStorageTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        $cache = new ApcuStorage();

        $cache->flush();
    }

    function testBase()
    {
        $cache = new ApcuStorage();

        $key = 'example_key1';
        $this->assertNull($cache->get($key));

        $value = new \stdClass(['value' => 1]);
        $cache->set($key, $value, 0);

        $this->assertEquals($value, $cache->get($key));

        $cache->delete($key);

        $this->assertNull($cache->get($key));

        $this->assertNull($cache->get('key1'));
        $this->assertNull($cache->get('key2'));

        $cache->set('key1', 'value1', 0);

        $this->assertTrue($cache->has('key1'));

        $this->assertEquals('value1', $cache->get('key1'));

        $cache->flush();
        $this->assertFalse($cache->has('key1'));


        $this->assertNull($cache->get('key1'));
    }
}
