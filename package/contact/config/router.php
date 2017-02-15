<?php

return [
    'routes' => [
        'contact'       => [
            'route'      => '{contact}',
            'controller' => 'contact.index',
            'action'     => 'index',
        ],
        'admin.contact' => [
            'route'      => 'contact/*',
            'controller' => 'contact.admin-department',
            'action'     => 'departments',
            'children'   => [
                'edit'        => ['route' => 'edit/<id>', 'action' => 'edit'],
                'add'         => ['route' => 'add', 'action' => 'add'],
                'settings'    => [
                    'route'      => 'settings',
                    'controller' => 'contact.admin-settings',
                    'action'     => 'edit',
                ],
                'permissions' => [
                    'controller' => 'contact.admin-permission',
                    'route'      => 'permissions',
                    'action'     => 'edit',
                ],
            ],
        ],
    ],
];