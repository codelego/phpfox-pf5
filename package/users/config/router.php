<?php

return [
    'chains' => [
        [
            'chain'  => 'profile',
            'route'  => '<name>/*',
            'filter' => 'user.profile_filter',
        ],
        [
            'chain'    => 'profile',
            'route'    => '{profile}/<name>/*',
            'filter'   => 'user.profile_filter',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'routes' => [
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
            'route'    => '{register}/<action>',
            'defaults' => [
                'controller' => 'user.register',
                'action'     => 'index',
            ],
        ],
        'settings'        => [
            'route'      => '{settings}/*',
            'controller' => 'user.settings',
            'action'     => 'index',
            'children'   => [
                'login-history' => [
                    'route'  => 'login-history',
                    'action' => 'login-history',
                ],
                'subscriptions' => [
                    'route'  => 'subscriptions',
                    'action' => 'subscriptions',
                ],
            ],
        ],
        'profile.members' => [
            'route'    => 'members',
            'defaults' => [
                'action'     => 'members',
                'controller' => 'user.profile',
            ],
        ],
        'admin.user'      => [
            'route'      => 'users/*',
            'controller' => 'user.admin-manage',
            'action'     => 'index',
        ],
    ],
];