<?php

return [
    'chains' => [
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
        'members.profile' => [
            'route'    => 'members',
            'defaults' => [
                'action'     => 'members',
                'controller' => 'user.profile',
            ],
        ],
    ],
];