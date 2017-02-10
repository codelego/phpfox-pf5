<?php

return [
    'chains'  => [
        [
            'chain'  => 'profile',
            'route'  => '{group}/<name>/*',
            'filter' => 'group.profile_filter',
        ],
    ],
    'routers' => [
        'profile.group' => [
            'route'    => 'group',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'group.profile',
            ],
        ],
    ],
];