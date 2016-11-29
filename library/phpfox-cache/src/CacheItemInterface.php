<?php

namespace Phpfox\Cache;

/**
 * Do not create instance of CacheItemInterface directly, it should be usage
 * as result of CacheStorageInterface getItem.
 *
 * @package Phpfox\Cache
 */
interface CacheItemInterface
{
    /**
     * Get time to life
     *
     * @return int
     */
    public function ttl();

    /**
     * Get key
     *
     * @return string
     */
    public function key();

    /**
     * Get stored value
     *
     * @return mixed|null
     */
    public function get();

    /**
     * @param mixed $value
     */
    public function set($value);

    /**
     * expires cache item afters.
     *
     * @param int $ttl
     *
     * @return mixed
     */
    public function expiresAfter($ttl);

    /**
     * Check current item is valid by time expiration condition.
     *
     * @return bool
     */
    public function isValid();
}
