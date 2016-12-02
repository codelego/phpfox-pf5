<?php

namespace Phpfox\Authentication;

use Phpfox\Logger\LogContainerFactory;

return [
    'autoload.psr4'  => [
        'Phpfox\\Authentication\\' => [
            'library/phpfox-authentication/src',
            'library/phpfox-authentication/test',
        ],
    ],
    'auth.adapters'  => [],
    'log.containers' => [
        'log.auth' => [],
    ],
    'service.map'    => [
        'auth'     => [null, AuthenticationManager::class],
        'log.auth' => [LogContainerFactory::class, null, 'log.auth'],
    ],
];