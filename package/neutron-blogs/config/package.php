<?php
namespace Neutron\Blog;

return [
    'psr4'           => [
        'Neutron\\Blog\\' => [
            'package/neutron-blogs/src',
            'package/neutron-blogs/test',
        ],
    ],
    'router.routes'  => [
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
    'controller.map' => [
        'blog.profile' => Controller\ProfileController::class,
    ],
];