<?php

namespace Phpfox\Cache;

/**
 * Class CacheItem
 *
 * @package Phpfox\Cache
 */
class CacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    protected $_key;

    /**
     * @var mixed
     */
    protected $_value;

    /**
     * @var int
     */
    protected $_ttls = 0;

    /**
     * @var int
     */
    protected $_expiration = 0;

    /**
     * CacheItem constructor.
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     * @param bool   $hit
     */
    public function __construct($key, $value, $ttl = null, $hit = true)
    {
        $this->_key = $key;
        $this->_value = $value;
        $this->_ttls = (int)$ttl;
        $this->expiresAfter($ttl);
    }

    public function ttl()
    {
        return $this->_ttls;
    }

    public function key()
    {
        return $this->_key;
    }

    public function get()
    {
        return $this->_value;
    }

    public function isHit()
    {
        return $this->_hit;
    }

    public function set($value)
    {
        $this->_value = $value;
        return $this;
    }

    public function isValid()
    {
        return $this->_expiration == 0 || time() <= $this->_expiration;
    }

    public function expiresAfter($ttl)
    {
        $this->_expiration = $ttl == 0 ? 0 : time() + (int)$ttl;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_key;
    }
}