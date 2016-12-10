<?php

return [
    'routes' => [
        'profile:blogs'     => [
            'route'    => '{blogs}',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'browse',
            ],
        ],
        'profile:view_blog' => [
            'route'    => '{blog}/<id>',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'view',
            ],
        ],
    ],
];