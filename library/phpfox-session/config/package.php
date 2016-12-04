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
        'files'    => FilesSessionHandler::class,
        'redis'    => RedisSessionHandler::class,
        'memcache' => MemcacheSessionHandler::class,
    ],
    'service.map'     => [
        'session'              => [null, SessionManager::class],
        'session.save_handler' => null,
    ],
];