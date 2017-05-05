<?php

return [
    'routes' => [
        'blogs'               => [
            'route'      => 'blogs/*',
            'controller' => 'blog.index',
            'action'     => 'index',
        ],
        'blogs.add'           => [
            'route'  => 'add',
            'action' => 'add',
        ],
        'admin.blog'          => [
            'route'      => 'blog/*',
            'controller' => 'blog.admin-post',
            'action'     => 'index',
            'children'   => [
                'post*'    => [
                    'route'      => 'manage(/<action>)',
                    'controller' => 'blog.admin-post',
                    'defaults'   => ['action' => 'index'],
                ],
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'blog.admin-category',
                ],
            ],
        ],
        'blog_post'           => [
            'route' => 'blog/post/*',
        ],
        'blog_post.view'      => [
            'route'    => '<id>',
            'defaults' => [
                'controller' => 'blog.post',
                'action'     => 'view',
            ],
        ],
        'browse_blog:profile' => [
            'route'    => '{blog}',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'browse',
            ],
        ],
        'view_blog:profile'   => [
            'route'    => '{blog}/<id>',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'view',
            ],
        ],
    ],
];