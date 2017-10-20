<?php

namespace Phpfox\Session;

return [
    'session_drivers' => [
        'files'    => FilesSession::class,
        'redis'    => RedisSession::class,
        'memcache' => MemcacheSession::class,
        'database' => DatabaseSession::class,
        'null'     => NullSession::class,
    ],
    'services'        => [
        'session' => [null, SessionFacades::class],
    ],
];