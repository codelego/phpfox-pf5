<?php

namespace Phpfox\Auth;

use Phpfox\Log\LogContainerFactory;

return [
    'autoload.psr4'  => [
        'Phpfox\\Auth\\' => [
            'library\phpfox-auth\src',
            'library\phpfox-auth\test',
        ],
    ],
    'auth.adapters'  => [],
    'log.containers' => [
        'log.auth' => [],
    ],
    'service.map'    => [
        'auth'     => [null, AuthManager::class],
        'log.auth' => [LogContainerFactory::class, null, 'log.auth'],
    ],
];