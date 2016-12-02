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
        'filesystem' => FilesystemCacheStorage::class,
        'apc'        => ApcuCacheStorage::class,
    ],
    'cache.adapters' => [
        'cache.filesystem' => [
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
            'cache.filesystem',
        ],
        'cache.apc'   => [CacheStorageFactory::class, null, 'cache.apc'],
        'cache'       => [
            CacheStorageFactory::class,
            null,
            'cache.filesystem',
        ],
    ],
    'service.map'    => [
        'cache.local' => [
            CacheStorageFactory::class,
            null,
            'cache.filesystem',
        ],
        'cache.apc'   => [CacheStorageFactory::class, null, 'cache.apc'],
        'cache'       => [
            CacheStorageFactory::class,
            null,
            'cache.filesystem',
        ],
    ],
];