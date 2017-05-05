<?php

namespace Phpfox\Cache;


use Memcached;

class MemcachedCacheStorage implements CacheStorageInterface
{
    /**
     * @var Memcached
     */
    protected $memcached;

    /**
     * @var array
     */
    protected $configs;

    /**
     * @var bool
     */
    protected $connected = false;

    /**
     * MemcacheCacheStorage constructor.
     *
     * @param $configs
     */
    public function __construct($configs)
    {
        $this->configs = array_merge([
            'port'           => 11211,
            'timeout'        => 1,
            'persistent'     => true,
            'retry_interval' => 15,
            'servers'        => ['127.0.0.1'],
        ], $configs);

    }

    public function saveItem(CacheItem $item)
    {
        $this->ready();
        return $this->memcached->set($item->key, $item, $item->ttl);
    }


    public function setItem($key, $value, $ttl = 0)
    {
        return $this->saveItem(new CacheItem($key, $value, $ttl));
    }

    public function setItems($keyValues, $ttl = 0)
    {
        $this->ready();

        foreach ($keyValues as $key => $value) {
            $this->saveItem(new CacheItem($key, $value, $ttl));
        }
        return true;
    }

    public function ready()
    {
        if ($this->connected) {
            return;
        }

        $this->memcached = new Memcached();
        $v = $this->configs;

        foreach ($v['servers'] as $a) {
            if (is_string($a)) {
                $a = ['host' => $a];
            }
            if (!isset($a['timeout'])) {
                $a['timeout'] = $v['timeout'];
            }
            if (!isset($a['port'])) {
                $a['port'] = $v['port'];
            }

            if (!isset($a['persistent'])) {
                $a['persistent'] = $v['persistent'];
            }

            if (!isset($a['retry_interval'])) {
                $a['retry_interval'] = $v['retry_interval'];
            }

            if (!isset($a['weight'])) {
                $a['weight'] = 1;
            }

            $this->memcached->addServer($a['host'], $a['port'], $a['weight']);
        }

        $this->connected = true;

    }

    public function getItems($keys = [])
    {
        $this->ready();

        $result = [];

        foreach ($keys as $k) {
            $result[$k] = $this->getItem($k);
        }

        return $result;
    }

    public function getItem($key)
    {
        $this->ready();

        $result = $this->memcached->get($key);

        if (false === $result) {
            return null;
        }

        return $result;
    }

    public function hasItem($key)
    {
        $this->ready();

        return null != $this->memcached->get($key);
    }

    public function flush()
    {
        $this->ready();

        $this->memcached->flush();
        return true;
    }

    public function deleteItem($key)
    {
        $this->ready();

        $this->memcached->delete($key);
    }

    public function deleteItems($keys)
    {
        $this->ready();

        array_walk($keys, function ($v) {
            $this->memcached->delete($v);
        });
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    function __sleep()
    {
        $this->memcached = null;
        $this->connected = false;
        return [];
    }

}