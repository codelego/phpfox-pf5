
Memcache support use
```php
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
        'cache.super' => '',
        'shared.cache' => [CacheStorageFactory::class, 'filesystem',[]],
    ],
];
```

01 . Cache manager

supper cache is local cache

- databases
- packages
- autoload
...


cache.super: cache master settings only (can not store on remote).
shared.cache: default cache store (can store on remote).

// delete super cache ? => kill all.