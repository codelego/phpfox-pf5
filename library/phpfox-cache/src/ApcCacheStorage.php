<?php

namespace Phpfox\Cache;

/**
 * Class ApcCacheStorage
 *
 * Require apc extension
 *
 * @package Phpfox\Cache
 */
class ApcCacheStorage implements CacheStorageInterface
{

    public function __construct()
    {
        if (!function_exists('apc_fetch')) {
            throw new InvalidArgumentException("Require apc extension");
        }
    }

    public function getItem($key)
    {
        $success = false;
        $result = apc_fetch($key, $success);
        return $result;
    }

    public function getItems($keys = [])
    {
        $success = false;
        $result = apc_fetch($keys, $success);
        return $result;
    }

    public function hasItem($key)
    {
        return apc_exists($key);
    }

    public function clear()
    {
        // http://php.net/manual/en/function.apc-clear-cache.php
        apc_clear_cache("user");
        return true;
    }

    public function deleteItem($key)
    {
        return apc_delete($key);
    }

    public function deleteItems($keys)
    {
        apc_delete($keys);
        return true;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        $this->save(new CacheItem($key, $value, $ttl));
    }

    public function save(CacheItemInterface $item)
    {
        apc_store($item->key(), $item->get(), $item->ttl());
    }
}