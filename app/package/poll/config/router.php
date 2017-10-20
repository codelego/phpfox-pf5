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
                'poll'     => [
                    'route'      => 'manage(/<action>)',
                    'controller' => 'poll.admin-poll',
                ],
            ],
        ],
    ],
];