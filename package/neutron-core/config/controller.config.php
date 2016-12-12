<?php
namespace Neutron\Core\Controller;

return [
    'core.index'                => IndexController::class,
    'core.admin-dashboard'      => AdminDashboardController::class,
    'core.admin-i18n'           => AdminI18nController::class,
    'core.admin-theme'          => AdminThemeController::class,
    'core.admin-settings'       => AdminSettingsController::class,
    'core.admin-package'        => AdminPackageController::class,
    'core.admin-mail-transport' => AdminMailTransportController::class,
    'core.error'                => ErrorController::class,
    'core.admin-login'          => AdminLoginController::class,
];