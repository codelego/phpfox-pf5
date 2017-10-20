<?php

return [
    'routes' => [
        'admin.dev' => [
            'route'    => 'dev/*',
            'children' => [
                'form'  => [
                    'route'      => 'form(/<action>)',
                    'controller' => 'dev.admin',
                ],
                'table' => [
                    'route'      => 'table(/<action>)',
                    'controller' => '_dev.table',
                ],
                'model' => [
                    'route'      => 'model(/<action>)',
                    'controller' => '_dev.model',
                ],
            ],
        ],

    ],
];