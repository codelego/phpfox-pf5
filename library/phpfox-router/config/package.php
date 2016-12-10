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
                'route'   => '<name>/*',
                'onMatch' => 'user.callback@onMatchProfileName',
            ],
            'profile:user'    => [
                'route'    => '{profile}/<name>/*',
                'onMatch'  => 'user.callback@onMatchProfileName',
                'defaults' => [
                    'controller' => 'user.profile',
                    'action'     => 'index',
                ],
            ],
            'profile:pages'   => [
                'route'    => '{pages}/<name>/*',
                'onMatch'  => 'pages.callback@onMatchProfileName',
                'defaults' => [
                    'controller' => 'pages.profile',
                    'action'     => 'index',
                ],
            ],
            'profile:groups'  => [
                'route'    => '{groups}/<name>/*',
                'onMatch'  => 'group.callback@onMatchProfileName',
                'defaults' => [
                ],
            ],
            'profile:events'  => [
                'route'    => '{events}/<name>/*',
                'onMatch'  => 'event.callback@onMatchProfileName',
                'defaults' => [
                    'controller' => 'pages.profile',
                    'action'     => 'index',
                ],
            ],
        ],
        'router.phrases' => [],
        'routes'  => [],
        'services'    => [
            'router' => [null, Router::class,],
        ],
    ];
}
