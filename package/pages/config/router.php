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
                'acl'      => [
                    'route'      => 'acl(/<action>)',
                    'controller' => 'pages.admin-acl',
                ],
                'pages'    => [
                    'route'      => '<action>',
                    'controller' => 'pages.admin-pages',
                ],
            ],
        ],
    ],
];