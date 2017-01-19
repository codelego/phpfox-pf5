<?php

namespace Phpfox\Cache;

interface CacheStorageInterface
{
    /**
     * @param string   $key
     * @param \Closure $fallback
     * @param int      $ttl
     *
     * @return mixed
     */
    public function with($key, $fallback, $ttl = 0);

    /**
     * @param string $key
     *
     * @return CacheItem|null
     */
    public function getItem($key);

    /**
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     *
     * @return mixed
     */
    public function setItem($key, $value, $ttl = 0);

    /**
     * @param CacheItem $item
     *
     * @return bool
     */
    public function saveItem(CacheItem $item);

    /**
     * @param array $keys
     *
     * @return CacheItem[]
     */
    public function getItems($keys = []);

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function hasItem($key);

    /**
     * @return mixed
     */
    public function flush();

    /**
     * @param $key
     *
     * @return mixed
     */
    public function deleteItem($key);

    /**
     * @param array $keys
     *
     * @return mixed
     */
    public function deleteItems($keys);
}
