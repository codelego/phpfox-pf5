<?php

return [
    'chains' => [
        'profile' => [
            'route'  => 'pages/<name>/*',
            'filter' => 'pages.callback@onRouteFilter',
        ],
    ],
    'routes' => [
        'browse_pages:profile' => [
            'route'    => 'pages',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'browse',
            ],
        ],
    ],
];