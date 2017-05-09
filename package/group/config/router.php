<?php

return [
    'chains'  => [
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
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'group.admin-category',
                ],
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'group.admin-settings',
                ],
                'acl'      => [
                    'route'      => 'acl(/<action>)',
                    'controller' => 'group.admin-acl',
                ],
                'group'    => [
                    'route'      => '<action>',
                    'controller' => 'group.admin-group',
                ],
            ],
        ],
    ],
];