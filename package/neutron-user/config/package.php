<?php

namespace Neutron\User;

return [
    'router.routes'   => [
        'login'    => [
            'route'    => '{login}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'login',
            ],
        ],
        'logout'   => [
            'route'    => '{logout}',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'logout',
            ],
        ],
        'register' => [
            'route'    => '{register}(/[:action])',
            'defaults' => [
                'controller' => 'user.auth',
                'action'     => 'index',
            ],
        ],
    ],
    'controller.map'  => [
        'user.auth'     => [null, Controller\AuthController::class],
        'user.register' => [null, Controller\RegisterController::class,],
    ],
    'event.listeners' => [
        'user.callback' => ['onMemberLoginBefore', 'onMemberLoginAfter'],
    ],
    'service.map'     => [
        'user.callback' => [null, Callback::class,],
    ],
];