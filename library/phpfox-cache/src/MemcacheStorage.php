<?php

namespace Phpfox\Cache;

use Memcache;

class MemcacheStorage implements StorageInterface
{
    /**
     * @var Memcache
     */
    protected $memcache;

    /**
     * @var int
     */
    protected $port = 11211;

    /**
     * @var int
     */
    protected $timeout = 1;

    /**
     * @var bool
     */
    protected $persistent = true;

    /**
     * @var array
     */
    protected $hosts = ['127.0.0.1'];

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var int
     */
    protected $retry_interval = 15;

    /**
     * MemcacheCacheStorage constructor.
     *
     * @param $params
     */
    public function __construct($params = [])
    {
        if (!empty($params['port'])) {
            $this->port = $params['port'];
        }

        if (!empty($params['persistent'])) {
            $this->persistent = (bool)$params['persistent'];
        }

        if (!empty($params['host'])) {
            if (is_string($params['host'])) {
                $this->hosts = array_map(function ($v) {
                    return trim($v);
                }, explode(',', $params['host']));
            } else {
                $this->hosts = $params['host'];
            }
        }
        if (!empty($params['prefix'])) {
            $this->prefix = $params['prefix'] . ';';
        }

        $this->connect();
    }


    public function set($key, $value, $ttl = 0)
    {
        $this->memcache->set($this->prefix . $key, $value, MEMCACHE_COMPRESSED,
            $ttl ? $ttl * 60 + time() : 0);
    }

    private function connect()
    {
        $this->memcache = new Memcache();

        foreach ($this->hosts as $host) {
            $this->memcache->addServer($host,
                $this->port,
                $this->persistent,
                1,
                $this->timeout,
                $this->retry_interval
            );
        }
    }

    public function get($key)
    {
        $result = $this->memcache->get($this->prefix . $key);

        if ($result === false) {
            return null;
        }

        return $result;
    }

    public function has($key)
    {
        return null != $this->memcache->get($this->prefix . $key);
    }

    public function flush()
    {
        $this->memcache->flush();
    }

    public function delete($key)
    {
        $this->memcache->delete($this->prefix . $key);
    }
}