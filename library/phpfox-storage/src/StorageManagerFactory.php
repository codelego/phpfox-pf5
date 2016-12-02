<?php

namespace Phpfox\Storage;


class StorageManagerFactory
{
    function factory()
    {
        return new StorageManager([
            'default' => 1,
            'factory' => new StorageAdapterFactory(),
            'map'     => [
                1 => [
                    'driver'   => StorageAdapterLocal::class,
                    'basePath' => null,
                    'baseUrl'  => null,
                ],
            ],
        ]);
    }
}