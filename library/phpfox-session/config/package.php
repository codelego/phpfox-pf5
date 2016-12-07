<?php

namespace Phpfox\Session;

return [
    'psr4'            => [
        'Phpfox\\Session\\' => [
            'library/phpfox-session/src',
            'library/phpfox-session/test',
        ],
    ],
    'session.drivers' => [
        'files'    => FilesSession::class,
        'redis'    => RedisSession::class,
        'memcache' => MemcacheSession::class,
    ],
    'service.map'     => [
        'session'              => [null, SessionManager::class],
        'session.save_handler' => null,
    ],
];