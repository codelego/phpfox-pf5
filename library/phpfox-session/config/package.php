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
        'driver' => 'files',
    ],
    'service.map'     => [
        'session' => [SessionManagerFactory::class, null],
    ],
];
