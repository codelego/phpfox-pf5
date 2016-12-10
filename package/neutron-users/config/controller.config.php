<?php
namespace Neutron\User;

return [
    'controllers' => [
        'user.auth'     => Controller\AuthController::class,
        'user.register' => Controller\RegisterController::class,
        'user.settings' => Controller\SettingsController::class,
        'user.profile'  => Controller\ProfileController::class,
    ],
];