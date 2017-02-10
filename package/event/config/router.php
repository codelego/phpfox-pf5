<?php

return [
    'chains'  => [
        [
            'chain'    => 'profile',
            'route'    => '{event}/<name>/*',
            'filter'   => 'event.profile_filter',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'routers' => [
        'profile.event' => [
            'route'    => 'event',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'event.profile',
            ],
        ],
    ],
];