<?php

namespace Phpfox\Cache;

return [
    'cache_drivers' => [
        'filesystem' => FilesCacheStorage::class,
        'apc'        => ApcuCacheStorage::class,
    ],
    'services'      => [
        'shared.cache' => [CacheStorageFactory::class, 'filesystem', ['directory' => 'cache']],
        'super.cache'  => [CacheStorageFactory::class, 'filesystem', ['directory' => 'super']],
    ],
];