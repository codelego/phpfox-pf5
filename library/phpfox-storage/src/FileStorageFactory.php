<?php

namespace Phpfox\Storage;


class FileStorageFactory implements FileStorageFactoryInterface
{
    public function factory($options)
    {
        $driver = \Phpfox::getConfig('storage.drivers', $options['driver']);
        return new $driver($options);
    }
}