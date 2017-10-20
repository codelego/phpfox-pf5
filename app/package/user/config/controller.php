<?php

namespace Neutron\User\Controller;

return [
    'user.auth'             => AuthController::class,
    'user.register'         => RegisterController::class,
    'user.settings'         => SettingsController::class,
    'user.profile'          => ProfileController::class,
    'user.admin-manage'     => AdminUserController::class,
    'user.admin-setting'    => AdminSettingController::class,
    'user.admin-permission' => AdminPermissionController::class,
    'user.admin-profile'    => AdminProfileController::class,
    'user.admin-level'      => AdminLevelController::class,
];