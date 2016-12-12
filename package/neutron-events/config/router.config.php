<?php

return [
    'chains'  => [
        'profile' => [
            'route'    => '{events}/<name>/*',
            'filter'   => 'event.callback@filterProfileName',
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