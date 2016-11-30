<?php

namespace Phpfox\Cache;


class FilesystemCacheStorageTest extends \PHPUnit_Framework_TestCase
{

    public function testMemcache()
    {
        $cache = \Phpfox::get('cache.memcached');

        $key = 'abc';
        $data = new \stdClass();
        $data->value = 1;

        $item = $cache->getItem($key);

        $this->assertNull($item);

        $cache->save(new CacheItem($key, $data, 0));

        $retry = $cache->getItem($key);

        $this->assertNotNull($retry);

        $this->assertEquals($retry->get(), $data);

        $cache->deleteItem($key);

        $cache->clear();
    }


    public function testApc()
    {
        $cache = \Phpfox::get('cache.apc');

        $key = 'abc';
        $data = new \stdClass();
        $data->value = 1;

        $item = $cache->getItem($key);

        $this->assertNull($item);

        $cache->save(new CacheItem($key, $data, 0));

        $retry = $cache->getItem($key);

        $this->assertNotNull($retry);

        $this->assertEquals($retry->get(), $data);

        $cache->deleteItem($key);

        $cache->clear();
    }

    public function testDefault()
    {
        $cache = \Phpfox::get('cache');

        $key = 'abc';
        $data = new \stdClass();
        $data->value = 1;

        $item = $cache->getItem($key);

        $this->assertNull($item);

        $cache->save(new CacheItem($key, $data, 0));

        $retry = $cache->getItem($key);

        $this->assertNotNull($retry);

        $this->assertEquals($retry->get(), $data);

        $cache->deleteItem($key);

        $cache->clear();
    }
}
