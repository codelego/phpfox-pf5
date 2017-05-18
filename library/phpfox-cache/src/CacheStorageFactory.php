<?php

namespace Phpfox\Cache;


class CacheStorageFactory
{
    /**
     * @param string|null  $driver
     * @param string|array $options
     *
     * @return CacheStorageInterface
     */
    public function factory($driver, $options)
    {
        if (!$driver) {
            $driver = $options['driver'];
        }
        $class = _param('cache_drivers', $driver);

        return new $class($options);
    }
}