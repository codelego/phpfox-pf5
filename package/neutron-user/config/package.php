<?php

namespace Neutron\User;

return [
    'psr4'            => [
        'Neutron\\User\\' => [
            'package/neutron-user/src',
            'package/neutron-user/test',
        ],
    ],
    'router.routes'   => [
        'login'           => [
            'route'    => '{login}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'login',
            ],
        ],
        'logout'          => [
            'route'    => '{logout}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'logout',
            ],
        ],
        'register'        => [
            'route'    => '{register}(/[:action])',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'index',
            ],
        ],
        'settings'        => [
            'route'    => '{settings}(/[:action])',
            'defaults' => [
                'controller' => 'user.settings',
                'action'     => 'index',
            ],
        ],
        'profile.members' => [
            'route'    => '[:name]/members',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'auth.passwords'  => [
        'pf5' => Auth\Pf5PasswordCompatible::class,
        'pf4' => Auth\Pf4PasswordCompatible::class,
        'se'  => Auth\SePasswordCompatible::class,
        'ow'  => Auth\OwPasswordCompatible::class,
    ],
    'models'          => [
        'user'          => [
            'table_factory',
            ':user',
            Model\User::class,
            'neutron-user/config/.meta.user.php',
        ],
        'auth_token'    => [
            'table_factory',
            ':user_auth_token',
            Model\AuthToken::class,
            'neutron-user/config/.meta.auth_token.php',
        ],
        'auth_password' => [
            'table_factory',
            ':user_auth_password',
            Model\AuthToken::class,
            'neutron-user/config/.meta.auth_password.php',
        ],
        'auth_remote'   => [
            'table_factory',
            ':user_auth_remote',
            Model\AuthToken::class,
            'neutron-user/config/.meta.auth_remote.php',
        ],
    ],
    'controller.map'  => [
        'user.auth'     => [null, Controller\AuthController::class],
        'user.register' => [null, Controller\RegisterController::class,],
        'user.settings' => [null, Controller\SettingsController::class,],
    ],
    'event.listeners' => [
        'user.callback' => ['onMemberLoginBefore', 'onMemberLoginAfter'],
    ],
    'service.map'     => [
        'user.callback'     => [null, Package::class,],
        'user.verify_email' => [null, Service\VerifyEmail::class],
        'user.browse'       => [null, Service\BrowseUser::class],
    ],
    'view.map'        => _get_view_map(['user' => 'neutron-user/view',]),
];