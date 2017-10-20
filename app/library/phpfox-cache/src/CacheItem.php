<?php

namespace Phpfox\Cache;


class CacheItem
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var mixed|object
     */
    public $value;

    /**
     * @var int
     */
    public $ttl;

    /**
     * CacheItem constructor.
     *
     * @param string       $key
     * @param mixed|object $value
     * @param int          $ttl
     */
    public function __construct($key, $value, $ttl)
    {
        $this->key = $key;
        $this->value = $value;
        $this->ttl = $ttl == 0 ? 0 : time() + 60 * $ttl;
    }
}