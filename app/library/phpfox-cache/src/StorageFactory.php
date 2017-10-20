<?php

namespace Phpfox\Cache;


class StorageFactory
{
    /**
     * @param string|null  $driver
     * @param string|array $options
     *
     * @return StorageInterface
     */
    public function factory($driver, $options)
    {
        if (is_string($options)) {
            $options = \Phpfox::get('package.loader')->getCacheParameter($options)->all();
        }

        if (!$driver) {
            $driver = $options['driver'];
        }

        $class = \Phpfox::param('cache_drivers', $driver);

        if (!$class or !class_exists($class)) {
            $class = FilesStorage::class;
            $options = ['directory' => 'cache'];
            \Phpfox::get('main.log')->emergency('Can not init log ' . $driver);
        }

        return new $class($options);
    }
}