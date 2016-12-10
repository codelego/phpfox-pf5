<?php

namespace Neutron\User;

return [
    'psr4'           => [
        'Neutron\\User\\' => [
            'package/neutron-users/src',
            'package/neutron-users/test',
        ],
    ],
    'routes'         => [
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
            'route'    => '{register}/<action>?',
            'defaults' => [
                'controller' => 'user.register',
                'action'     => 'index',
            ],
        ],
        'settings'        => [
            'route'    => '{settings}/<action>?',
            'defaults' => [
                'action' => 'index',
            ],
        ],
        'profile:members' => [
            'route'    => 'members',
            'defaults' => [
                'action'     => 'members',
                'controller' => 'user.profile',
            ],
        ],
        'profile:groups'  => [
            'route'    => 'groups',
            'group'    => 'profile',
            'defaults' => [
                'action'     => 'groups',
                'controller' => 'group.profile',
            ],
        ],
        'profile:events'  => [
            'route'    => 'events',
            'group'    => 'profile',
            'defaults' => [
                'action'     => 'events',
                'controller' => 'events.profile',
            ],
        ],
        'profile:pages'   => [
            'route'    => 'pages',
            'defaults' => [
                'action'     => 'pages',
                'controller' => 'pages.profile',
            ],
        ],
    ],
    'auth.passwords' => [
        'pf5' => Auth\Pf5PasswordCompatible::class,
        'pf4' => Auth\Pf4PasswordCompatible::class,
        'se'  => Auth\SePasswordCompatible::class,
        'ow'  => Auth\OwPasswordCompatible::class,
    ],
    'models'         => [
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
    'controllers'    => [
        'user.auth'     => Controller\AuthController::class,
        'user.register' => Controller\RegisterController::class,
        'user.settings' => Controller\SettingsController::class,
        'user.profile'  => Controller\ProfileController::class,
    ],
    'services'       => [
        'user.callback'     => [null, Service\EventListener::class,],
        'user.verify_email' => [null, Service\VerifyEmail::class],
        'user.browse'       => [null, Service\Browse::class],
        'auth.factory'      => [null, Service\AuthFactory::class],
    ],
    'templates'      => _get_view_map(['user' => 'neutron-users/view',]),
];