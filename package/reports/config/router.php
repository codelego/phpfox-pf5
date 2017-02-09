<?php

return [
    'routes' => [
        'admin.abuse-report' => [
            'route'      => 'abuse-reports/category/*',
            'controller' => 'abuse-report.admin-category',
            'action'     => 'index',
            'children'   => [
                'edit'   => ['route' => 'edit/<id>', 'action' => 'edit'],
                'add'    => ['route' => 'add', 'action' => 'add'],
                'delete' => ['route' => 'delete', 'action' => 'delete'],
            ],
        ],
    ],
];