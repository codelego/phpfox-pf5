<?php

return [
    'phrases' => [],
    'chains'  => [

    ],
    'routes'  => [
        'admin'                     => [
            'route'    => 'admincp/*',
            'defaults' => [
                'controller' => 'core.admin.index',
                'action'     => 'dashboard',
            ],
        ],
        'admin.core.i18n'           => [
            'route'    => 'core/i18n/*',
            'defaults' => [
                'controller' => 'core.admin.i18n',
                'action'     => 'index',
            ],
        ],
        'admin.core.i18n.languages' => [
            'route'    => 'languages',
            'defaults' => [
                'action' => 'languages',
            ],
        ],
        'api'                       => [
            'route' => 'api/*',
        ],
        'ajax'                      => [
            'route' => 'ajax/*',
        ],
        'home'                      => [
            'route'    => '/',
            'defaults' => [
                'controller' => 'core.index',
                'action'     => 'index',
            ],
        ],
        'api.menu'                  => [
            'route'    => 'menu',
            'defaults' => [
                'controller' => 'MenuApiController',
                'action'     => 'listing',
            ],
        ],
        'api.menu.item'             => [
            'route'    => '<id>',
            'defaults' => [
                'controller' => 'MenuApiController',
                'action'     => 'view',
            ],
        ],
        'profile.index'             => [
            'route'    => '/',
            'defaults' => [
                'action' => 'index',
            ],
        ],
    ],
];