<?php

return [
    'routes' => [
        'photos'      => [
            'route'      => 'photos',
            'controller' => 'photo.index',
            'action'     => 'index',
        ],
        'admin.photo' => [
            'route'      => 'photo/*',
            'controller' => 'photo.admin-photo',
            'action'     => 'index',
            'children'   => [
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'photo.admin-category',
                ],
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'photo.admin-settings',
                ],
                'album'    => [
                    'route'      => 'album/(<action>)',
                    'controller' => 'photo.admin-album',
                ],
                'manage'    => [
                    'route'      => 'manage(/<action>)',
                    'controller' => 'photo.admin-photo',
                ],
            ],
        ],
    ],
];