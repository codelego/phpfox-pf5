<?php

namespace Neutron\Core;

use Neutron\Core\Service\I18nMessageLoader;

return [
    'psr4'            => [
        'Neutron\\Core\\' => [
            'package/neutron-core/src',
            'package/neutron-core/test',
        ],
    ],
    'requirejs.paths' => [
        'jquery'     => 'jscript/jquery/jquery',
        'bootstrap'  => 'jscript/bootstrap/bootstrap',
        'jqueryui'   => 'jscript/jquery-ui/jqueryui',
        'underscore' => 'jscript/underscore/underscore.min',
        'tiny_mce'   => 'jscript/tinymce/jquery.tinymce.min',
    ],
    'static.js'       => [
        'require' => 'jscript/requirejs/require.js',
    ],
    'static.css'      => [
        'bootstrap' => 'theme/default/stylesheets/bundle.css',
    ],
    'requirejs.shim'  => [
        'bootstrap'  => [
            'deps'    => ['jquery'],
            'exports' => 'bootstrap',
        ],
        'jqueryui'   => [
            'deps'    => [
                'jquery',
            ],
            'exports' => 'jqueryui',
        ],
        'underscore' => [
            'deps'    => [
                'jquery',
            ],
            'exports' => '_',
        ],
    ],
    'router.routes'   => [
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
            'route'    => '{admincp}',
            'group'    => '@admincp',
            'defaults' => [
                'controller' => 'core.admin-dashboard',
                'action'     => 'index',
            ],
        ],
        'admincp.core.theme'     => [
            'route'    => '{admincp}/core/theme(/[:action])',
            'group'    => '@admincp',
            'defaults' => [
                'controller' => 'core.admin-theme',
                'action'     => 'index',
            ],
        ],
        'admincp.core.package'   => [
            'route'    => '{admincp}/core/package(/[:action])',
            'group'    => '@admincp',
            'defaults' => [
                'controller' => 'core.admin-package',
                'action'     => 'index',
            ],
        ],
        'admincp.core.settings'  => [
            'route'    => '{admincp}/core/settings(/[:action])',
            'group'    => '@admincp',
            'defaults' => [
                'controller' => 'core.admin-settings',
                'action'     => 'index',
            ],
        ],
    ],
    'controller.map'  => [
        'core.index'           => Controller\IndexController::class,
        'core.admin-dashboard' => Controller\AdminDashboardController::class,
        'core.admin-language'  => Controller\AdminLanguageController::class,
        'core.admin-theme'     => Controller\AdminThemeController::class,
        'core.admin-settings'  => Controller\AdminSettingsController::class,
        'core.admin-package'   => Controller\AdminPackageController::class,
        'core.error'           => Controller\ErrorController::class,
    ],
    'service.map'     => [
        'i18n.loader' => [null, I18nMessageLoader::class],
    ],
    'views.map'       => _get_view_map([
        'core'   => 'neutron-core/view',
        'layout' => 'neutron-core/layout',
    ]),
    'session.drivers' => [
        'database' => Service\SessionHandlerDatabase::class,
    ],
];