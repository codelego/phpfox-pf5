<?php

return [
    'routes' => [
        'admin.report' => [
            'route'      => 'report/*',
            'controller' => 'report.admin-report',
            'action'     => 'index',
            'children'   => [
                'category' => [
                    'route'      => 'category(/<action>)',
                    'controller' => 'report.admin-category',
                ],
                'manage'   => [
                    'route'      => 'manage(/<action>)',
                    'controller' => 'report.admin-report',
                ],
            ],
        ],
    ],
];