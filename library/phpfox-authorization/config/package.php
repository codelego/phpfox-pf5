<?php
namespace Phpfox\Authentication;

use Phpfox\Authorization\AuthorizationManager;

return [
    'services' => [
        'authorization' => [null, AuthorizationManager::class],
    ],
];