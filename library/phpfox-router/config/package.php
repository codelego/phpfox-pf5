<?php

namespace Phpfox\Router {

    return [
        'psr4'           => [
            'Phpfox\\Router\\' => [
                'library/phpfox-router/src',
                'library/phpfox-router/test',
            ],
        ],
        'router.chains'  => [
            'admincp'         => [
                'route'    => '{admincp}/*',
                'defaults' => [],
            ],
            'rest'            => [
                'route'    => '{rest}/*',
                'defaults' => [],
            ],
            'ajax'            => [
                'route' => '{ajax}/*',
            ],
            'profile:general' => [
                'route'  => '<name>/*',
                'callback' => 'user.callback@checkProfileName',
            ],
            'profile:user'    => [
                'route'    => '{profile}/<name>/*',
                'callback'   => 'user.callback@checkProfileName',
                'defaults' => [
                    'controller' => 'user.profile',
                    'action'     => 'index',
                ],
            ],
            'profile:pages'   => [
                'route'    => '{pages}/<name>/*',
                'callback'   => 'pages.callback@checkProfileId',
                'defaults' => [
                    'controller' => 'pages.profile',
                    'action'     => 'index',
                ],
            ],
            'profile:groups'  => [
                'route'    => '{groups}/<name>/*',
                'callback'   => 'user.callback@checkProfileName',
                'defaults' => [
                ],
            ],
            'profile:events'  => [
                'route'    => '{events}/<name>/*',
                'callback'   => 'user.callback@checkProfileName',
                'defaults' => [
                    'controller' => 'pages.profile',
                    'action'     => 'index',
                ],
            ],
        ],
        'router.phrases' => [],
        'router.routes'  => [],
        'service.map'    => [
            'router'         => [null, Router::class,],
        ],
    ];
}
