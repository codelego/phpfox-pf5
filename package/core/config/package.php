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
        'i18n.loader'            => [null, Service\I18nMessageLoader::class],
        'mailer.factory'         => [null, Service\MailAdapterFactory::class],
        'storage.factory'        => [null, Service\FileStorageFactory::class],
        'session.save_handler'   => [Service\SessionFactory::class,],
        'mvc.events.loader'      => [null, Service\EventLoader::class],
        'core.callback'          => [null, Service\EventListener::class],
        'navigation.loader'      => [null, Service\NavigationLoader::class],
        'core.i18n'              => [null, Service\I18nManager::class],
        'core.packages'          => [null, Service\Packages::class],
        'core.themes'            => [null, Service\LayoutThemes::class],
        'core.mails'             => [null, Service\MailManager::class],
        'core.roles'             => [null, Service\AclManager::class],
        'core.storage'           => [null, Service\StorageManager::class],
        'core.setting'           => [null, Service\SettingManager::class],
        'core.cache'             => [null, Service\CacheManager::class],
        'core.log'               => [null, Service\LogManager::class],
        'authorization.provider' => [null, Service\PermissionProvider::class],
        'layout_loader'          => [null, Service\LayoutManager::class],
        'menu.main.primary'      => [NavigationFactory::class, 'main'],
        'menu.main.secondary'    => [NavigationFactory::class, null],
        'menu.main.mini'         => [NavigationFactory::class, 'main.mini'],
        'menu.admin.primary'     => [NavigationFactory::class, 'admin'],
        'menu.admin.secondary'   => [NavigationFactory::class, null],
        'menu.admin.buttons'     => [NavigationFactory::class, null],
    ],
    'templates'       => _view_map([
        'default' => [
            'layout-editor' => 'package/core/layout-editor',
            'core'          => 'package/core/view',
            'layout'        => 'package/core/layout/default',
            'grid'          => 'package/core/layout/grid',
        ],
        'admin'   => ['layout' => 'package/core/layout/admin'],
    ]),
    'session.drivers' => [
        'database' => Service\DatabaseSession::class,
    ],
];