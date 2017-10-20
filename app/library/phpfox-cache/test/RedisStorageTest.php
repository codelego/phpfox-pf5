<?php

namespace Phpfox\Cache;


class RedisStorageTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $cache = new RedisStorage([
            'host' => '127.0.0.1',
            'port' => 6379,
        ]);

        $cache->flush();

        $key = 'example_key1';
        $this->assertNull($cache->get($key));

        $value = "hello";
        $cache->set($key, $value, 0);

        $this->assertSame($value, $cache->get($key));

        $cache->delete($key);

        $this->assertNull($cache->get($key));

        $this->assertNull($cache->get('key1'));
        $this->assertNull($cache->get('key2'));

        $cache->set('key1', 'value1', 0);
        $cache->set('key1', 'value1', 0);

        $this->assertTrue($cache->has('key1'));

        $this->assertEquals('value1', $cache->get('key1'));

        $cache->flush();
        $this->assertFalse($cache->has('key1'));


        $this->assertNull($cache->get('key1'));
    }
}
