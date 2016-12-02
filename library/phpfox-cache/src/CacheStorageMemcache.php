<?php
namespace Phpfox\Cache;

use Memcache;

class CacheStorageMemcache implements CacheStorageInterface
{
    /**
     * @var Memcache
     */
    protected $memcache;

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

        $this->memcache->set($key, $value, MEMCACHE_COMPRESSED, $ttl);
    }

    public function ready()
    {
        if ($this->connected) {
            return;
        }

        $this->memcache = new Memcache();
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
            $this->memcache->addServer($a['host'], $a['port'], $a['weight']);
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

        return $this->memcache->get($key);
    }

    public function hasItem($key)
    {
        $this->ready();

        return null != $this->memcache->get($key);
    }

    public function clear()
    {
        $this->ready();

        $this->memcache->flush();
        return true;
    }

    public function deleteItem($key)
    {
        $this->ready();

        $this->memcache->delete($key);
    }

    public function deleteItems($keys)
    {
        $this->ready();

        array_walk($keys, function ($v) {
            $this->memcache->delete($v);
        });
    }

    function __sleep()
    {
        $this->memcache->close();
        $this->connected = false;
        return [];
    }

    function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }


}