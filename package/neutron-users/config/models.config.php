<?php

namespace Neutron\User;

return [
    'models' => [
        'user'          => [
            'table_factory',
            ':user',
            Model\User::class,
            'neutron-users/config/.meta.user.php',
        ],
        'auth_token'    => [
            'table_factory',
            ':user_auth_token',
            Model\AuthToken::class,
            'neutron-users/config/.meta.auth_token.php',
        ],
        'auth_password' => [
            'table_factory',
            ':user_auth_password',
            Model\AuthPassword::class,
            'neutron-users/config/.meta.auth_password.php',
        ],
        'auth_remote'   => [
            'table_factory',
            ':user_auth_remote',
            Model\AuthRemote::class,
            'neutron-users/config/.meta.auth_remote.php',
        ],
    ],
];