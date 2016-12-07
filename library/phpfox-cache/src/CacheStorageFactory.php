<?php

namespace Phpfox\Cache;


class CacheStorageFactory
{
    /**
     * @param string|null  $class
     * @param string|array $options
     *
     * @return CacheStorageInterface
     */
    public function factory($class, $options)
    {
        if (is_string($options)) {
            $options = \Phpfox::getParam('cache.adapters', $options);
        }

        if (!$class) {
            $class = \Phpfox::getParam('cache.drivers', $options['driver']);
        }
        return new $class($options);
    }
}