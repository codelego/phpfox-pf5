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
        if (is_string($options)) {
            $options = _get('package.loader')->getCacheParameter($options)->all();
        }

        if (!$driver) {
            $driver = $options['driver'];
        }

        $class = _param('cache_drivers', $driver);

        if (!$class or !class_exists($class)) {
            $class = FilesCacheStorage::class;
            $options = ['directory' => 'cache'];
            _get('main.log')->emergency('Can not init log ' . $driver);
        }

        return new $class($options);
    }
}