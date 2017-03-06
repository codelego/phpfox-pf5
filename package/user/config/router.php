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
            'controller' => 'user.profile',
            'action'     => 'index',
        ],
    ],
    'routes' => [
        'login'           => [
            'route'    => '{login}',
            'controller' => 'user.auth',
            'action'     => 'login',
        ],
        'logout'          => [
            'route'    => '{logout}',
            'controller' => 'user.auth',
            'action'     => 'logout',
        ],
        'register'        => [
            'route'      => '{register}',
            'controller' => 'user.register',
            'action'     => 'index',
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
            'action'     => 'members',
            'controller' => 'user.profile',
        ],
        'admin.user'      => [
            'route'      => 'user/*',
            'controller' => 'user.admin-manage',
            'action'     => 'index',
        ],
    ],
];