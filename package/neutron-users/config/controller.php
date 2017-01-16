<?php
namespace Neutron\User\Controller;

return [
    'user.auth'         => AuthController::class,
    'user.register'     => RegisterController::class,
    'user.settings'     => SettingsController::class,
    'user.profile'      => ProfileController::class,
    'user.admin-manage' => AdminManageController::class,
];