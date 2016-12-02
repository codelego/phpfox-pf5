<?php

namespace Phpfox\Session;

return [
    'autoload.psr4'   => [
        'Phpfox\\Session\\' => [
            'library/phpfox-session/src',
            'library/phpfox-session/test',
        ],
    ],
    'session.drivers' => [
        'files'    => SessionHandlerFiles::class,
        'redis'    => SessionHandlerRedis::class,
        'memcache' => SessionHandlerMemcache::class,
    ],
    'service.map'     => [
        'session' => [SessionManagerFactory::class, null],
    ],
];
