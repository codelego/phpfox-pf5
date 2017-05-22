<?php

namespace Neutron\Core;

use Phpfox\Navigation\NavigationFactory;

return [
    'requirejs.paths' => [
        'jquery'     => 'package/jquery/jquery',
        'bootstrap'  => 'package/bootstrap/bootstrap',
        'jqueryui'   => 'package/jquery/jqueryui',
        'underscore' => 'package/underscore/underscore.min',
        'tiny_mce'   => 'package/tinymce/jquery.tinymce.min',
        'core'       => 'package/core/main',
        'extras'     => 'package/core/extras',
    ],
    'static.js'       => [
        'require' => 'package/requirejs/require.js',
    ],
    'static.css'      => [
        'main'          => '@css/main.css',
        //        'font'          => '//fonts.googleapis.com/css?family=Roboto',
        'custom'        => '@css/custom.css',
        'admin.login'   => '@css/admin-login.css',
        'core-test.css' => '@css/core-test.css',
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
    'services'        => [
        'i18n.loader'          => [null, Service\I18nLoader::class],
        'core.i18n'            => [null, Service\I18nManager::class],
        'core.listener'        => [null, Service\EventListener::class],
        'core.packages'        => [null, Service\PackageManager::class],
        'core.themes'          => [null, Service\ThemeManager::class],
        'core.mails'           => [null, Service\MailManager::class],
        'core.permission'      => [null, Service\PermissionManager::class],
        'core.storage'         => [null, Service\StorageManager::class],
        'core.setting'         => [null, Service\SettingManager::class],
        'core.cache'           => [null, Service\CacheManager::class],
        'core.log'             => [null, Service\LogManager::class],
        'core.profile'         => [null, Service\ProfileManager::class],
        'core.adapter'         => [null, Service\AdapterManager::class],
        'layout_loader'        => [null, Service\LayoutManager::class],
        'core.layout'          => [null, Service\LayoutManager::class],
        'menu.main.primary'    => [NavigationFactory::class, 'main'],
        'menu.main.secondary'  => [NavigationFactory::class, null],
        'menu.main.mini'       => [NavigationFactory::class, 'main.mini'],
        'menu.admin.primary'   => [NavigationFactory::class, 'admin'],
        'menu.admin.secondary' => [NavigationFactory::class, null],
        'menu.admin.buttons'   => [NavigationFactory::class, null],
    ],
];