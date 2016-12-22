<?php

namespace Phpfox\Cache;

return [
    'cache.drivers'  => [
        'filesystem' => FilesCacheStorage::class,
        'apc'        => ApcuCacheStorage::class,
    ],
    'cache.adapters' => [
        'cache.files' => [
            'driver' => 'filesystem',
        ],
        'cache.apc'   => [
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
    'services'       => [
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