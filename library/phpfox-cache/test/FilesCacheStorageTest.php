<?php

namespace Phpfox\Cache;


class FilesCacheStorageTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        $cache = new FilesCacheStorage([]);

        $cache->flush();
    }

    function testBase()
    {
        $cache = new FilesCacheStorage([]);

        $key = 'example_key1';
        $this->assertNull($cache->getItem($key));

        $value = new \stdClass(['value' => 1]);
        $cache->setItem($key, $value, 0);

        $this->assertEquals($value, $cache->getItem($key));

        $cache->deleteItem($key);

        $this->assertNull($cache->getItem($key));

        $arrays = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $cache->setItems($arrays, 0);

        $this->assertEquals($arrays, $cache->getItems(array_keys($arrays)));

        $this->assertEquals('value1', $cache->getItem('key1'));
        $this->assertEquals('value2', $cache->getItem('key2'));

        $cache->deleteItems(array_keys($arrays));

        $this->assertNull($cache->getItem('key1'));
        $this->assertNull($cache->getItem('key2'));

        $cache->setItem('key1', 'value1', 0);

        $this->assertTrue($cache->hasItem('key1'));

        $this->assertEquals('value1', $cache->getItem('key1'));

        $cache->flush();
        $this->assertFalse($cache->hasItem('key1'));


        $this->assertNull($cache->getItem('key1'));
    }
}
