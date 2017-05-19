<?php

namespace Phpfox\Cache;

interface StorageInterface
{
    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key);

    /**
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     */
    public function set($key, $value, $ttl = 0);

    /**
     * @param $key
     */
    public function delete($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * @return null
     */
    public function flush();
}
