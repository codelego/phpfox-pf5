<?php
namespace Phpfox\Authentication;

use Phpfox\Authorization\AuthorizationManager;

return [
    'service.map' => [
        'authorization' => [null, AuthorizationManager::class],
    ],
];