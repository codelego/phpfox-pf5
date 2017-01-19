<?php

return [
    'chains' => [
        ['chain'  => 'profile',
         'route'  => 'pages/<name>/*',
         'filter' => 'pages.profile_filter',]
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