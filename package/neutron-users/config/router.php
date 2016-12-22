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
            'route'    => '{settings}/<action>',
            'defaults' => [
                'action' => 'index',
            ],
        ],
        'profile.members' => [
            'route'    => 'members',
            'defaults' => [
                'action'     => 'members',
                'controller' => 'user.profile',
            ],
        ],
    ],
];