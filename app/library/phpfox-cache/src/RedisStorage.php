<?php

namespace Phpfox\Cache;

use Redis;

class RedisStorage implements StorageInterface
{
    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $host = '127.0.0.1';

    /**
     * @var int
     */
    protected $port = 6379;

    /**
     * @var string
     */
    protected $auth = '';

    /**
     * @var int
     */
    protected $dbIndex = 0;

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
        if (!empty($params['host'])) {
            $this->host = $params['host'];
        }
        if (!empty($params['port'])) {
            $this->port = (int)$params['port'];
        }
        if (!empty($params['db_index'])) {
            $this->dbIndex = (int)$params['db_index'];
        }
        if (!empty($params['auth'])) {
            $this->auth = $params['auth'];
        }
        if (!empty($params['prefix'])) {
            $this->prefix = (string)$params['prefix'] . ';';
        }
        $this->connect();
    }

    protected function connect()
    {
        $this->redis = new Redis();
        $this->redis->pconnect($this->host, $this->port);
        if ($this->auth) {
            $this->redis->auth($this->auth);
        }
        $this->redis->select($this->dbIndex);
    }

    public function get($key)
    {
        $result = $this->redis->get($this->prefix . $key);
        if ($result === false) {
            return null;
        }
        return unserialize($result);
    }

    public function set($key, $value, $ttl = 0)
    {
        $this->redis->set($this->prefix . $key, serialize($value));
        if ($ttl) {
            $this->redis->expireAt($this->prefix . $key, $ttl * 60 + time());
        }
    }

    public function has($key)
    {
        return $this->redis->exists($this->prefix . $key);
    }

    public function flush()
    {
        $this->redis->flushDB();
    }

    public function delete($key)
    {
        $this->redis->delete($this->prefix . $key);
    }
}