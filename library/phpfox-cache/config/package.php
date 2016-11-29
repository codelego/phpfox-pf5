<?php

namespace Phpfox\Cache;

return [
    'autoload.psr4'  => [
        'Phpfox\\Cache\\' => [
            'library\phpfox-cache\src',
            'library\phpfox-cache\test',
        ],
    ],
    'cache.drivers'  => [
        'filesystem' => FilesystemCacheStorage::class,
        'apc'        => ApcCacheStorage::class,
        'apcu'       => ApcuCacheStorage::class,
    ],
    'cache.adapters' => [
        'cache.filesystem' => [
            'driver' => 'filesystem',
        ],
        'cache.apc'        => [
            'driver' => 'apc',
        ],
        'cache.apcu'       => [
            'driver' => 'apcu',
        ],
    ],
    'service.map'    => [
        'cache.local' => [
            CacheStorageFactory::class,
            null,
            'cache.filesystem',
        ],
        'cache.apc'   => [CacheStorageFactory::class, null, 'cache.apc'],
        'cache.apcu'  => [CacheStorageFactory::class, null, 'cache.apcu'],
        'cache'       => [
            CacheStorageFactory::class,
            null,
            'cache.filesystem',
        ],
    ],
];