<?php

return [
    'routes' => [
        'browse_blogs:profile' => [
            'route'    => '{blogs}',
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