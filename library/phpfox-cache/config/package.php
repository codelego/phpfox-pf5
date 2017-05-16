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
    'services'       => [
        'cache.default' => [CacheStorageFactory::class, 'filesystem', ['directory' => 'cache']],
        'cache.super'   => [CacheStorageFactory::class, 'filesystem', ['directory' => 'super']],
    ],
];