<?php
namespace Neutron\Blog;

return [
    'psr4'        => [
        'Neutron\\Blog\\' => [
            'package/neutron-blogs/src',
            'package/neutron-blogs/test',
        ],
    ],
    'routes'      => [
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
    'controllers' => [
        'blog.profile' => Controller\ProfileController::class,
    ],
    'services'    => [
        'blog.callback' => [null, Service\EventListener::class],
    ],
];