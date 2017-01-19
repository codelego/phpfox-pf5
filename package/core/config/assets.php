<?php

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
        'main'          => '@css/main.css',
        'font'          => '//fonts.googleapis.com/css?family=Roboto',
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
];