<?php

return [
    'chains'  => [
        [
            'chain'  => 'profile',
            'route'  => '{groups}/<name>/*',
            'filter' => 'group.profile_filter',
        ],
    ],
    'routers' => [
        'profile.groups' => [
            'route'    => 'groups',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'group.profile',
            ],
        ],
    ],
];