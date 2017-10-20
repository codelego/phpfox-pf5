<?php

namespace Phpfox\Cache;

/**
 * @requires extension memcache
 */
class MemcacheStorageTest extends \PHPUnit_Framework_TestCase
{
    function testBase()
    {
        $cache = new MemcacheStorage([
            'port'           => 11211,
            'timeout'        => 1,
            'persistent'     => true,
            'retry_interval' => 15,
            'host'           => ['127.0.0.1'],
        ]);

        $cache->flush();

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
