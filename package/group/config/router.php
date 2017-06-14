<?php

return [
    'chains' => [
        [
            'chain'  => 'profile',
            'route'  => '{group}/<name>/*',
            'filter' => 'group.profile_filter',
        ],
    ],
    'routes' => [
        'profile.group' => [
            'route'    => 'group',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'group.profile',
            ],
        ],
        'admin.group'   => [
            'route'      => 'group/*',
            'controller' => 'group.admin-group',
            'action'     => 'index',
            'children'   => [
                'category'   => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'group.admin-category',
                ],
                'settings'   => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'group.admin-settings',
                ],
                'permission' => [
                    'route'      => 'permission(/<action>)',
                    'controller' => 'group.admin-permission',
                ],
                'level'      => [
                    'route'      => 'level(/<action>)',
                    'controller' => 'group.admin-level',
                ],
                'group'      => [
                    'route'      => '<action>',
                    'controller' => 'group.admin-group',
                ],
            ],
        ],
    ],
];