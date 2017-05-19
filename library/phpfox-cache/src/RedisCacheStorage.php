<?php

namespace Phpfox\Cache;

use Redis;

class RedisCacheStorage implements CacheStorageInterface
{

    /**
     * @var Redis
     */
    protected $redis;

    /**
     * RedisCacheStorage constructor.
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->redis = new Redis();
        $this->redis->pconnect($params['host'], $params['port']);

    }

    public function getItem($key)
    {
        $result = $this->redis->get($key);
        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        return $this->saveItem(new CacheItem($key, $value, $ttl));
    }

    public function setItems($keyValues, $ttl = 0)
    {
        foreach ($keyValues as $key => $value) {
            $this->saveItem(new CacheItem($key, $value, $ttl));
        }

        return true;
    }

    public function saveItem(CacheItem $item)
    {
        $this->redis->set($item->key, $item->value);
    }

    public function getItems($keys = [])
    {
        $result = [];
        foreach ($keys as $k) {
            $result[$k] = $this->getItem($k);
        }

        return $result;
    }

    public function hasItem($key)
    {
        return $this->redis->exists($key);
    }

    public function flush()
    {
        $this->redis->flushDB();
    }

    public function deleteItem($key)
    {
        $this->redis->delete($key);
    }

    public function deleteItems($keys)
    {
        foreach ($keys as $key) {
            $this->redis->delete($key);
        }
    }
}