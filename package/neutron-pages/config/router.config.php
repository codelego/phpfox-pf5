<?php

return [
    'routes' => [
        'profile:pages' => [
            'route'    => 'pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
    ],
];