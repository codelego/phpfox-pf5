<?php

namespace Phpfox\Cache;

return [
    'autoload.psr4'  => [
        'Phpfox\\Cache\\' => [
            'library/phpfox-cache/src',
            'library/phpfox-cache/test',
        ],
    ],
    'cache.drivers'  => [
        'filesystem' => CacheStorageFiles::class,
        'apc'        => CacheStorageApcu::class,
    ],
    'cache.adapters' => [
        'cache.files' => [
            'driver' => 'filesystem',
        ],
        'cache.apc'        => [
            'driver' => 'apc',
        ],
    ],
    'cache.map'      => [
        'cache.local' => [
            CacheStorageFactory::class,
            null,
            'cache.files',
        ],
        'cache.apc'   => [CacheStorageFactory::class, null, 'cache.apc'],
        'cache'       => [
            CacheStorageFactory::class,
            null,
            'cache.files',
        ],
    ],
    'service.map'    => [
        'cache.local' => [
            CacheStorageFactory::class,
            null,
            'cache.files',
        ],
        'cache.apc'   => [CacheStorageFactory::class, null, 'cache.apc'],
        'cache'       => [
            CacheStorageFactory::class,
            null,
            'cache.files',
        ],
    ],
];