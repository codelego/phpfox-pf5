<?php

namespace Phpfox\Storage;


class StorageServiceFactory implements StorageServiceFactoryInterface
{
    public function factory($options)
    {
        $driver = \Phpfox::config('storage.drivers', $options['driver']);
        return new $driver($options);
    }
}