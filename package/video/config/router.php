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
                'acl'      => ['route' => 'acl(/<action>)', 'controller' => 'video.admin-acl'],
                'utility'  => ['route' => 'utility(/<action>)', 'controller' => 'video.admin-utility'],
            ],
        ],
    ],
];