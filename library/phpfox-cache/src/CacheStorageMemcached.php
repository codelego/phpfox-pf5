<?php
namespace Phpfox\Cache;


use Memcached;

class CacheStorageMemcached implements CacheStorageInterface
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

    public function setItem($key, $value, $ttl = 0)
    {
        $this->ready();

        $this->memcached->set($key, $value, $ttl);
    }

    public function ready()
    {
        if ($this->connected) {
            return;
        }

        $this->memcached = new Memcached();
        $v = $this->configs;

        foreach ($v['servers'] as $a) {
            if (!isset($a['timeout'])) {
                $a['timeout'] = $v['timeout'];
            }

            if (!isset($a['persistent'])) {
                $a['persistent'] = $v['persistent'];
            }

            if (!isset($a['retry_interval'])) {
                $a['retry_interval'] = $v['retry_interval'];
            }

            $this->memcached->addServer($a['host'], $a['port'], $a['weight']);
        }

        $this->connected = true;

    }

    public function getItems($keyValues = [])
    {
        $this->ready();

        $result = [];
        foreach ($keyValues as $k => $v) {
            $result[$k] = $this->getItem($v);
        }

        return $result;
    }

    public function getItem($key)
    {
        $this->ready();

        return $this->memcached->get($key);
    }

    public function hasItem($key)
    {
        $this->ready();

        return null != $this->memcached->get($key);
    }

    public function clear()
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

    function __sleep()
    {
        $this->memcached = null;
        $this->connected = false;
        return [];
    }
}