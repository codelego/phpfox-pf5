<?php

namespace Neutron\Core;

return [
    'requirejs.paths' => [
        'jquery'     => 'jscript/jquery/jquery',
        'bootstrap'  => 'jscript/bootstrap/bootstrap',
        'jqueryui'   => 'jscript/jquery-ui/jqueryui',
        'underscore' => 'jscript/underscore/underscore.min',
        'tiny_mce'   => 'jscript/tinymce/jquery.tinymce.min',
        'main'       => 'package/core/main',
    ],
    'static.js'       => [
        'require' => 'jscript/requirejs/require.js',
    ],
    'static.css'      => [
        'main'                  => '@css/main.css',
        'font'                  => '//fonts.googleapis.com/css?family=Roboto',
        'admin.login'           => '@css/admin-login.css',
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
        'mailer.factory'         => [null, Service\MailTransportFactory::class],
        'storage.factory'        => [null, Service\FileStorageFactory::class],
        'session.save_handler'   => [Service\SessionFactory::class,],
        'mvc.events.loader'      => [null, Service\EventLoader::class],
        'core.callback'          => [null, Service\EventListener::class],
        'navigation.loader'      => [null, Service\NavigationLoader::class],
        'core.i18n_language'     => [null, Service\I18nLanguage::class],
        'core.packages'          => [null, Service\Packages::class],
        'core.themes'            => [null, Service\Themes::class],
        'core.roles'             => [null, Service\Roles::class],
        'authorization.provider' => [null, Service\PermissionProvider::class],
    ],
    'templates'       => _view_map([
        'default' => [
            'core'   => 'package/core/view',
            'layout' => 'package/core/layout/default',
        ],
        'admin'   => ['layout' => 'package/core/layout/admin'],
    ]),
    'session.drivers' => [
        'database' => Service\DatabaseSession::class,
    ],
];