<?php

namespace Phpfox\Cache;

return [
    'cache_drivers' => [
        'files'     => FilesStorage::class,
        'apc'       => ApcuStorage::class,
        'memcache'  => MemcacheStorage::class,
        'memcached' => MemcachedStorage::class,
        'redis'     => RedisStorage::class,
    ],
    'services'      => [
        'shared.cache' => [StorageFactory::class, null, 'shared.cache'],
        'super.cache'  => [StorageFactory::class, 'files', ['directory' => 'super']],
    ],
];