<?php

namespace Neutron\Pages;

return [
    'psr4'           => [
        'Neutron\\Pages\\' => [
            'package/neutron-pages/src',
            'package/neutron-pages/test',
        ],
    ],
    'router.routes'  => [
        'profile.pages' => [
            'route'    => '[:name]/pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
    ],
    'controller.map' => [
        'pages.profile' => Controller\ProfileController::class,
    ],
];