<?php

return [
    'chains'  => [
        [
            'chain'    => 'profile',
            'route'    => '{events}/<name>/*',
            'filter'   => 'event.profile_filter',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'routers' => [
        'profile.events' => [
            'route'    => 'events',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'events.profile',
            ],
        ],
    ],
];