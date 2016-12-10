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
        'profile:pages' => [
            'route'    => 'pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
    ],
    'models'         => [
        'pages' => [
            'table_factory',
            ':pages',
            Model\Pages::class,
            'neutron-pages/config/.meta.pages.php',
        ],
    ],
    'controller.map' => [
        'pages.profile' => Controller\ProfileController::class,
    ],
    'service.map'    => [
        'pages.callback' => Callback::class,
        'pages.browse'   => Service\Browse::class,
    ],
];