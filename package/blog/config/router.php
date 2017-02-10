<?php

return [
    'routes' => [
        'browse_blog:profile' => [
            'route'    => '{blog}',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'browse',
            ],
        ],
        'view_blog:profile'    => [
            'route'    => '{blog}/<id>',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'view',
            ],
        ],
    ],
];