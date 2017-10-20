<?php

return [
    'routes' => [
        'admin.marketplace' => [
            'route'      => 'marketplace/*',
            'controller' => 'marketplace.admin-listing',
            'action'     => 'index',
            'children'   => [
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'marketplace.admin-category',
                ],
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'marketplace.admin-settings',
                ],
                'manage'   => [
                    'route'      => '<action>',
                    'controller' => 'marketplace.admin-listing',
                ],
            ],
        ],
    ],
];