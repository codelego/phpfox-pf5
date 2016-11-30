<?php

namespace Neutron\Core;

return [
    'autoload.psr4'     => [
        'Neutron\\Core\\' => [
            'package/neutron-core/src',
            'package/neutron-core/test',
        ],
    ],
    'router.route'      => [
        'home'           => [
            'route'    => '/',
            'wheres'   => [],
            'defaults' => [
                'controller' => Controller\IndexController::class,
                'action'     => 'index',
            ],
        ],
        'rest.menus'     => [
            'route'    => '{rest}/menus',
            'method'   => 'GET',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'listing',
            ],
        ],
        'rest.menu.item' => [
            'route'    => '{rest}/menu/[:id]',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'view',
            ],
        ],
    ],
    'service.factories' => [

    ],
    'view.map'          => [

    ],
];