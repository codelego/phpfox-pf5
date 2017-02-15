<?php

return [
    'routes' => [
        'admin.report' => [
            'route'      => 'report/category/*',
            'controller' => 'report.admin-category',
            'action'     => 'index',
            'children'   => [
                'edit'   => ['route' => 'edit/<id>', 'action' => 'edit'],
                'add'    => ['route' => 'add', 'action' => 'add'],
                'delete' => ['route' => 'delete', 'action' => 'delete'],
            ],
        ],
    ],
];