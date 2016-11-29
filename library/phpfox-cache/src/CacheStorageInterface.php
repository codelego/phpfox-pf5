<?php

namespace Phpfox\Cache;

/**
 * Interface CacheStorageInterface
 *
 * @package Phpfox\Cache
 */
interface CacheStorageInterface
{
    /**
     * @param string $key
     *
     * @return mixed
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
     * @param array $keys
     *
     * @return mixed
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
    public function clear();

    /**
     * @param $key
     *
     * @return mixed
     */
    public function deleteItem($key);

    /**
     * @param string $keys
     *
     * @return mixed
     */
    public function deleteItems($keys);

    /**
     * @param CacheItemInterface $item
     *
     * @return mixed
     */
    public function save(CacheItemInterface $item);
}
