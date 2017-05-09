<?php

return [
    'routes' => [
        'admin.poll' => [
            'route'      => 'poll/*',
            'controller' => 'poll.admin-poll',
            'action'     => 'index',
            'children'   => [
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'poll.admin-settings',
                ],
                'acl'      => [
                    'route'      => 'acl(/<action>)',
                    'controller' => 'poll.admin-acl',
                ],
                'poll'   => [
                    'route'      => '<action>',
                    'controller' => 'poll.admin-poll',
                ],
            ],
        ],
    ],
];