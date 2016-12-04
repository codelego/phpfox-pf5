<?php

namespace Phpfox\Authentication;

use Phpfox\Logger\LogContainerFactory;

return [
    'psr4'           => [
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
        'auth'     => [null, AuthFacades::class],
        'log.auth' => [LogContainerFactory::class, null, 'log.auth'],
    ],
];