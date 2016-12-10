<?php

namespace Neutron\Core;

return [
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
    'services'        => [
        'i18n.loader'          => [null, Service\I18nMessageLoader::class],
        'mailer.factory'       => [null, Service\MailTransportFactory::class],
        'storage.factory'      => [null, Service\FileStorageFactory::class],
        'package.loader'       => [null, Service\PackageLoader::class,],
        'session.save_handler' => [Service\SessionFactory::class,],
        'mvc.events.loader'    => [null, Service\EventLoader::class],
        'core.callback'        => [null, Service\EventListener::class],
    ],
    'templates'       => _get_view_map([
        'core'   => 'neutron-core/view',
        'layout' => 'neutron-core/layout',
    ]),
    'session.drivers' => [
        'database' => Service\DatabaseSession::class,
    ],
    'models'          => [
    ],
];