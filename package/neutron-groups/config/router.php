<?php

return [
    'chains' => [
        'profile' => [
            'route'  => '{groups}/<name>/*',
            'filter' => 'group.callback@filterProfileName',
        ],
    ],
    'routers'=>[
        'profile.groups'  => [
            'route'    => 'groups',
            'defaults' => [
                'action'     => 'browse',
                'controller' => 'group.profile',
            ],
        ]
    ]
];