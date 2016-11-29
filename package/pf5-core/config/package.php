<?php

namespace Pf5\Core;

return [
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