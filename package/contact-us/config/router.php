<?php

return [
    'routes' => [
        'contact-us'       => [
            'route'      => '{contact-us}',
            'controller' => 'contact-us.index',
            'action'     => 'index',
        ],
        'admin.contact-us' => [
            'route'      => 'contact-us/*',
            'controller' => 'contact-us.admin-department',
            'action'     => 'departments',
            'children'   => [
                'edit'        => ['route' => 'edit/<id>', 'action' => 'edit'],
                'add'         => ['route' => 'add', 'action' => 'add'],
                'settings'    => [
                    'route'      => 'settings',
                    'controller' => 'contact-us.admin-settings',
                    'action'     => 'edit',
                ],
                'permissions' => [
                    'controller' => 'contact-us.admin-permission',
                    'route'      => 'permissions',
                    'action'     => 'edit',
                ],
            ],
        ],
    ],
];