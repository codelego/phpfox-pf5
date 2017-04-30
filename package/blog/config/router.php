<?php

return [
    'routes' => [
        'blogs'                    => [
            'route'      => 'blogs/*',
            'controller' => 'blog.index',
            'action'     => 'index',
        ],
        'blogs.add'                => [
            'route'  => 'add',
            'action' => 'add',
        ],
        'admin.blog'               => [
            'route'      => 'blog/*',
            'controller' => 'blog.admin-category',
            'action'     => 'index',
        ],
        'admin.blog.category'      => [
            'route'      => 'category/*',
            'controller' => 'blog.admin-category',
            'action'     => 'index',
        ],
        'admin.blog.category.add'  => [
            'route'  => 'add',
            'action' => 'add',
        ],
        'admin.blog.category.edit' => [
            'route'  => 'edit/<id>',
            'action' => 'edit',
        ],
        'blog_post'                => [
            'route' => 'blog/post/*',
        ],
        'blog_post.view'           => [
            'route'    => '<id>',
            'defaults' => [
                'controller' => 'blog.post',
                'action'     => 'view',
            ],
        ],
        'browse_blog:profile'      => [
            'route'    => '{blog}',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'browse',
            ],
        ],
        'view_blog:profile'        => [
            'route'    => '{blog}/<id>',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'view',
            ],
        ],
    ],
];