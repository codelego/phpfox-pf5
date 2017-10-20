<?php

return [
    'chains' => [
        [
            'chain'  => 'profile',
            'route'  => 'pages/<name>/*',
            'filter' => 'pages.profile_filter',
        ],
    ],
    'routes' => [
        'profile.pages' => [
            'route'    => 'pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
        'admin.pages'   => [
            'route'      => 'pages/*',
            'controller' => 'pages.admin-pages',
            'action'     => 'index',
            'children'   => [
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'pages.admin-category',
                ],
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'pages.admin-settings',
                ],
                'level'      => [
                    'route'      => 'levels(/<action>)',
                    'controller' => 'pages.admin-level',
                ],
                'permission'      => [
                    'route'      => 'permission(/<action>)',
                    'controller' => 'pages.admin-permission',
                ],
                'pages'    => [
                    'route'      => '<action>',
                    'controller' => 'pages.admin-pages',
                ],
            ],
        ],
    ],
];