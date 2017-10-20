<?php

namespace Phpfox\Auth;

use Phpfox\Logger\LogContainerFactory;

return [
    'services' => [
        'auth'              => [null, AuthFacades::class],
        'auth.factory'      => [null, AuthFactoryInterface::class],
        'auth.log'          => [LogContainerFactory::class, null, 'auth_log'],
        'auth.storage'      => [null, AuthStorageSession::class],
        'acl'               => [null, PermissionFacades::class],
        'permission.loader' => [null, PermissionLoader::class],
    ],
];