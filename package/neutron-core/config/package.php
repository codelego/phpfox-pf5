<?php

namespace Neutron\Core;

return [
    'autoload.psr4'  => [
        'Neutron\\Core\\' => [
            'package/neutron-core/src',
            'package/neutron-core/test',
        ],
    ],
    'router.routes'  => [
        'home'                   => [
            'route'    => '/',
            'wheres'   => [],
            'defaults' => [
                'controller' => 'core.index',
                'action'     => 'index',
            ],
        ],
        'rest.menus'             => [
            'route'    => 'menus',
            'method'   => 'GET',
            'group'    => '@rest',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'listing',
            ],
        ],
        'rest.menu.item'         => [
            'route'    => 'menu/[:id]',
            'group'    => '@rest',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'view',
            ],
        ],
        'admincp.core.dashboard' => [
            'route'    => 'core/settings(/[:action])',
            'group'    => '@admincp',
            'defaults' => [
                'controller' => 'core.admincp-dashboard',
                'action'     => 'index',
            ],
        ],
    ],
    'controller.map' => [
        'core.index'             => Controller\IndexController::class,
        'core.admincp-dashboard' => Controller\AdminDashboardController::class,
        'core.admincp-language'  => Controller\AdminLanguageController::class,
        'core.admincp-settings'  => Controller\AdminSettingsController::class,
    ],
    'service.map'    => [

    ],
    'view.map'       => [

    ],
];