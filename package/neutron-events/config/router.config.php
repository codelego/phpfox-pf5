<?php

return [
    'chains' => [
        'profile' => [
            'route'    => '{events}/<name>/*',
            'filter'   => 'event.callback@filterProfileName',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
    ],
];