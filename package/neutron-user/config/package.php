<?php

namespace Neutron\User;

return [
    'router.routes'   => [
        'login'           => [
            'route'    => '{login}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'login',
            ],
        ],
        'logout'          => [
            'route'    => '{logout}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'logout',
            ],
        ],
        'register'        => [
            'route'    => '{register}(/[:action])',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'index',
            ],
        ],
        'settings'        => [
            'route'    => '{settings}(/[:action])',
            'defaults' => [
                'controller' => 'user.settings',
                'action'     => 'index',
            ],
        ],
        'profile.members' => [
            'route'    => '[:name]/members',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'controller.map'  => [
        'user.auth'     => [null, Controller\AuthController::class],
        'user.register' => [null, Controller\RegisterController::class,],
        'user.settings' => [null, Controller\SettingsController::class,],
    ],
    'event.listeners' => [
        'user.callback' => ['onMemberLoginBefore', 'onMemberLoginAfter'],
    ],
    'service.map'     => [
        'user.callback' => [null, Package::class,],
    ],
];