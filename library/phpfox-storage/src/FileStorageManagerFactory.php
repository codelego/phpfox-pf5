<?php

namespace Phpfox\Storage;


class FileStorageManagerFactory
{
    function factory()
    {
        return new FileStorageManager([
            'default' => 1,
            'factory' => new FileStorageFactory(),
            'map'     => [
                1 => [
                    'driver'   => LocalFileStorage::class,
                    'basePath' => null,
                    'baseUrl'  => null,
                ],
            ],
        ]);
    }
}