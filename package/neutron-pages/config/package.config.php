<?php

namespace Neutron\Pages;

return [
    'psr4'           => [
        'Neutron\\Pages\\' => [
            'package/neutron-pages/src',
            'package/neutron-pages/test',
        ],
    ],
    'routes'  => [
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
    'controllers' => [
        'pages.profile' => Controller\ProfileController::class,
    ],
    'services'    => [
        'pages.callback' => Service\EventListener::class,
        'pages.browse'   => Service\Browse::class,
    ],
];