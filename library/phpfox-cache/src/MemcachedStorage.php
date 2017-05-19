<?php

namespace Phpfox\Cache;


use Memcached;

class MemcachedStorage implements StorageInterface
{
    /**
     * @var Memcached
     */
    protected $memcached;

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
     * @param array $params
     */
    public function __construct($params)
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
        $this->memcached->set($this->prefix . $key, $value, $ttl ? $ttl * 60 + time() : 0);
    }

    private function connect()
    {
        $this->memcached = new Memcached();

        foreach ($this->hosts as $host) {
            $this->memcached->addServer($host, $this->port, 1);
        }
    }

    public function get($key)
    {
        $result = $this->memcached->get($this->prefix . $key);

        if (false === $result) {
            return null;
        }

        return $result;
    }

    public function has($key)
    {
        return null != $this->memcached->get($this->prefix . $key);
    }

    public function flush()
    {
        $this->memcached->flush();
    }

    public function delete($key)
    {
        $this->memcached->delete($this->prefix . $key);
    }
}