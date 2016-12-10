<?php

return [
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
];