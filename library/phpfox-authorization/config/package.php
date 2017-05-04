<?php

namespace Phpfox\Authorization;

return [
    'services' => [
        'authorization'          => [null, AuthorizationManager::class],
        'authorization.provider' => [null, PermissionProviderInterface::class],
    ],
];