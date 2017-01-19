<?php

namespace Neutron\User\Model;

return [
    'user'              => [
        'table_factory',
        ':user',
        User::class,
        'users/config/.meta.user.php',
    ],
    'auth_token'        => [
        'table_factory',
        ':user_auth_token',
        AuthToken::class,
        'users/config/.meta.auth_token.php',
    ],
    'auth_password'     => [
        'table_factory',
        ':user_auth_password',
        AuthPassword::class,
        'users/config/.meta.auth_password.php',
    ],
    'auth_remote'       => [
        'table_factory',
        ':user_auth_remote',
        AuthRemote::class,
        'users/config/.meta.auth_remote.php',
    ],
    'user_auth_history' => [
        'table_factory',
        ':user_auth_history',
        AuthHistory::class,
        'users/config/.meta.user_auth_history.php',
    ],
];