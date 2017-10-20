<?php

return [
    'chains' => [
        [
            'chain'    => 'profile',
            'route'    => '{event}/<name>/*',
            'filter'   => 'event.profile_filter',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'routes' => [
        'profile.event' => [
            'route'    => 'event',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'event.profile',
            ],
        ],
        'admin.event'   => [
            'route'      => 'event/*',
            'controller' => 'event.admin-event',
            'action'     => 'index',
            'children'   => [
                'category'   => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'event.admin-category',
                ],
                'settings'   => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'event.admin-settings',
                ],
                'permission' => [
                    'route'      => 'permission(/<action>)',
                    'controller' => 'event.admin-permission',
                ],
                'level'      => [
                    'route'      => 'level(/<action>)',
                    'controller' => 'event.admin-level',
                ],
                'event'      => [
                    'route'      => '<action>',
                    'controller' => 'event.admin-event',
                ],
            ],
        ],
    ],
];