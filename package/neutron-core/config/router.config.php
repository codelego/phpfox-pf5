<?php

return [
    'phrases' => [],
    'chains'  => [
        'admincp' => [
            'route'    => 'admincp/*',
            'filter'   => 'core.callback@onRouteAdminFilter',
            'compiler' => 'core.callback@onRouteAdminCompile',
        ],
        'api'     => [
            'route' => 'api/*',
        ],
        'ajax'    => [
            'route' => 'ajax/*',
        ],
    ],
    'routes'  => [
        'home'          => [
            'route'    => '/',
            'wheres'   => [],
            'defaults' => [
                'controller' => 'core.index',
                'action'     => 'index',
            ],
        ],
        'menus:api'     => [
            'route'    => 'menus',
            'method'   => 'GET',
            'group'    => 'rest',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'listing',
            ],
        ],
        'menu.item:api' => [
            'route'    => 'menu/<id>',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'view',
            ],
        ],
        'index:profile' => [
            'route'    => '/',
            'defaults' => [
                'action' => 'index',
            ],
        ],
    ],
];