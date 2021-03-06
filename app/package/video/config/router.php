<?php

return [
    'routes' => [
        'video'       => [
            'route'      => 'video/*',
            'controller' => 'video.index',
            'action'     => 'index',
        ],
        'video.embed' => [
            'route'  => 'embed',
            'action' => 'embed',
        ],
        'admin.video' => [
            'route'      => 'video/*',
            'controller' => 'video.admin-video',
            'action'     => 'index',
            'children'   => [
                'category' => ['route' => 'category(/<action>)', 'controller' => 'video.admin-category'],
                'settings' => ['route' => 'settings(/<action>)', 'controller' => 'video.admin-settings'],
                'provider' => ['route' => 'provider(/<action>)', 'controller' => 'video.admin-provider'],
                'encoder'  => ['route' => 'encoder(/<action>)', 'controller' => 'video.admin-encoder'],
                'manage'   => ['route' => 'manage(/<action>)', 'controller' => 'video.admin-video'],
            ],
        ],
    ],
];