<?php

return [
    'routes' => [
        'profile.groups' => [
            'route'    => '<name>/groups',
            'defaults' => [
                'controller' => 'groups.profile',
                'action'     => 'browse',
            ],
        ],
    ],
];