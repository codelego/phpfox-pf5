<?php

namespace Phpfox\Storage;


class StorageAdapterFactory implements StorageAdapterFactoryInterface
{
    public function factory($options)
    {
        $driver = \Phpfox::getConfig('storage.drivers', $options['driver']);
        return new $driver($options);
    }
}