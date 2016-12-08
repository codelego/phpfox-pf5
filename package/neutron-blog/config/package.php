<?php
namespace Neutron\Blog;

return [
    'psr4'           => [
        'Neutron\\Blog\\' => [
            'package/neutron-blog/src',
            'package/neutron-blog/test',
        ],
    ],
    'router.routes'  => [
        'profile.blogs' => [
            'route'    => '[:name]/blogs',
            'filter'   => '@profile',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'controller.map' => [
        'blog.profile' => Controller\ProfileController::class,
    ],
];