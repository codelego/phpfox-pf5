<?php

namespace Phpfox\Cache;

return [
    'cache_drivers' => [
        'filesystem' => FilesCacheStorage::class,
        'apc'        => ApcuCacheStorage::class,
        'memcache'   => MemcacheCacheStorage::class,
        'memcached'  => MemcachedCacheStorage::class,
        'redis'      => RedisCacheStorage::class,
    ],
    'services'      => [
        'shared.cache' => [CacheStorageFactory::class, null, 'shared.cache'],
        'super.cache'  => [CacheStorageFactory::class, 'filesystem', ['directory' => 'super']],
    ],
];