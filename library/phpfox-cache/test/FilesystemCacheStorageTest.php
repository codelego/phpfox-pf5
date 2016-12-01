<?php

namespace Phpfox\Cache;


class FilesystemCacheStorageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function provideCacheDriver()
    {
        return [
            ['cache.local',],
            ['cache.apc',],
            ['cache.apcu',],
        ];
    }

    /**
     * @param $driver
     *
     * @dataProvider provideCacheDriver
     */
    public function testMemcache($driver)
    {
        $cache = \Phpfox::get($driver);

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
