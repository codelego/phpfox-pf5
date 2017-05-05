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
                '*'        => ['route' => '<action>'],
            ],
        ],
    ],
];