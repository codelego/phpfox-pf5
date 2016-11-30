<?php

namespace Phpfox\Memcache;

use Phpfox\Cache\CacheStorageFactory;

return [
    'autoload.psr4'   => [
        'Phpfox\\Memcache\\' => [
            'library/phpfox-memcache/src',
            'library/phpfox-memcache/test',
        ],
    ],
    'session.drivers' => [
        'memcache'  => MemcacheSessionSaveHandler::class,
        'memcached' => MemcachedSessionSaveHandler::class,
    ],
    'cache.drivers'   => [
        'memcache'  => MemcacheCacheStorage::class,
        'memcached' => MemcachedCacheStorage::class,
    ],
    'cache.adapters'  => [
        'cache.memcached' => [
            'driver'         => 'memcached',
            'port'           => 11211,
            'timeout'        => 1,
            'persistent'     => true,
            'retry_interval' => 15,
            'servers'        => ['127.0.0.1'],
        ],
        'cache.memcache'  => [
            'driver'         => 'memcache',
            'port'           => 11211,
            'timeout'        => 1,
            'persistent'     => true,
            'retry_interval' => 15,
            'servers'        => ['127.0.0.1'],
        ],
    ],
    'service.map'     => [
        'cache.memcache'  => [
            CacheStorageFactory::class,
            null,
            'cache.memcache',
        ],
        'cache.memcached' => [
            CacheStorageFactory::class,
            null,
            'cache.memcached',
        ],
    ],
];
