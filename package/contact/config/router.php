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
            'action'     => 'index',
            'children'   => [
                'department'  => [
                    'route'      => 'department(/<action>)',
                    'controller' => 'contact.admin-department',
                ],
                'permissions' => [
                    'controller' => 'contact.admin-permission',
                    'route'      => 'permissions',
                ],
            ],
        ],
    ],
];