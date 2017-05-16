<?php

namespace Phpfox\Session;

return [
    'session.drivers' => [
        'files'    => FilesSession::class,
        'redis'    => RedisSession::class,
        'memcache' => MemcacheSession::class,
        'null'     => NullSession::class,
    ],
    'services'        => [
        'session'              => [null, SessionManager::class],
        'session.save_handler' => null,
    ],
];