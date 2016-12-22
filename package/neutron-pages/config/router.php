<?php

return [
    'chains' => [
        'profile' => [
            'route'  => 'pages/<name>/*',
            'filter' => 'pages.callback@onRouteFilter',
        ],
    ],
    'routes' => [
        'profile.pages' => [
            'route'    => 'pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
    ],
];