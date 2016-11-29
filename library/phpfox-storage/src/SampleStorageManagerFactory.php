<?php

namespace Phpfox\Storage;


class SampleStorageManagerFactory
{
    function factory()
    {
        return new StorageManager([
            'default' => 1,
            'factory' => new StorageServiceFactory(),
            'map'     => [
                1 => [
                    'driver'   => LocalStorageService::class,
                    'basePath' => null,
                    'baseUrl'  => null,
                ],
            ],
        ]);
    }
}