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
        ':auth_token',
        AuthToken::class,
        'users/config/.meta.auth_token.php',
    ],
    'auth_password'     => [
        'table_factory',
        ':auth_password',
        AuthPassword::class,
        'users/config/.meta.auth_password.php',
    ],
    'auth_remote'       => [
        'table_factory',
        ':auth_remote',
        AuthRemote::class,
        'users/config/.meta.auth_remote.php',
    ],
    'auth_history'      => [
        'table_factory',
        ':auth_history',
        AuthHistory::class,
        'users/config/.meta.auth_history.php',
    ],
    'user_verification' => [
        'table_factory',
        ':user_verification',
        UserVerification::class,
        'users/config/.meta.user_verification.php',
    ],
];