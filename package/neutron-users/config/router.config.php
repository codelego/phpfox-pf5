<?php

return [
    'chains' => [
        'user_settings' => [
            'route'    => '{settings}/*',
            'defaults' => [
                'controller' => 'user.settings',
                'action'     => 'index',
            ],
        ],
        'profile'       => [
            [
                'route'    => '<name>/*',
                'filter'   => 'user.callback@onRouteFilter',
                'compiler' => 'user.callback@onRouteCompile',
            ],
            [
                'route'    => '{profile}/<name>/*',
                'filter'   => 'user.callback@onRouteFilter',
                'defaults' => [
                    'controller' => 'user.profile',
                    'action'     => 'index',
                ],
            ],
        ],
    ],
    'routes' => [
        'login'                  => [
            'route'    => '{login}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'login',
            ],
        ],
        'logout'                 => [
            'route'    => '{logout}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'logout',
            ],
        ],
        'register'               => [
            'route'    => '{register}/<action>?',
            'defaults' => [
                'controller' => 'user.register',
                'action'     => 'index',
            ],
        ],
        'settings'               => [
            'route'    => '{settings}/<action>?',
            'defaults' => [
                'action' => 'index',
            ],
        ],
        'browse_members:profile' => [
            'route'    => 'members',
            'defaults' => [
                'action'     => 'members',
                'controller' => 'user.profile',
            ],
        ],
        'browse_groups:profile'  => [
            'route'    => 'groups',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'group.profile',
            ],
        ],
        'browse_events:profile'  => [
            'route'    => 'events',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'events.profile',
            ],
        ],
        'browse_pages:profile'   => [
            'route'    => 'pages',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'pages.profile',
            ],
        ],
        'account:user_settings'  => [
            'route'    => '{account}',
            'defaults' => ['action' => 'account'],
        ],
    ],
];