<?php

namespace Neutron\User\Model;

return [
    'user'              => [
        'table_factory',
        ':user',
        User::class,
        'package/user/config/model/user.php',
    ],
    'user_level'        => [
        'table_factory',
        ':user_level',
        UserLevel::class,
        'package/user/config/model/user_level.php',
    ],
    'user_catalog' => [
        'table_factory',
        ':user_catalog',
        UserCatalog::class,
        'package/user/config/model/user_catalog.php',
    ],
    'auth_token'        => [
        'table_factory',
        ':auth_token',
        AuthToken::class,
        'package/user/config/model/auth_token.php',
    ],
    'auth_password'     => [
        'table_factory',
        ':auth_password',
        AuthPassword::class,
        'package/user/config/model/auth_password.php',
    ],
    'auth_remote'       => [
        'table_factory',
        ':auth_remote',
        AuthRemote::class,
        'package/user/config/model/auth_remote.php',
    ],
    'auth_history'      => [
        'table_factory',
        ':auth_history',
        AuthHistory::class,
        'package/user/config/model/auth_history.php',
    ],
    'user_verify_token' => [
        'table_factory',
        ':user_verify_token',
        UserVerifyToken::class,
        'package/user/config/model/user_verify_token.php',
    ],
];