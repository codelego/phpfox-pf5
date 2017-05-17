<?php

namespace Phpfox\Auth;

use Phpfox\Logger\LogContainerFactory;

return [
    'auth.adapters'  => [],
    'log.containers' => [
        'log.auth' => [],
    ],
    'services'       => [
        'auth'                   => [null, AuthFacades::class],
        'auth.factory'           => [null, AuthFactoryInterface::class],
        'auth.log'               => [LogContainerFactory::class, null, 'log.auth'],
        'auth.storage'           => [null, AuthStorageSession::class],
        'authorization'          => [null, AuthorizationManager::class],
        'authorization.provider' => [null, PermissionProviderInterface::class],
    ],
];