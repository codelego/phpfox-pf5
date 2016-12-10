<?php
namespace Neutron\Core;

return [
    'controllers' => [
        'core.index'                => Controller\IndexController::class,
        'core.admin-dashboard'      => Controller\AdminDashboardController::class,
        'core.admin-language'       => Controller\AdminLanguageController::class,
        'core.admin-theme'          => Controller\AdminThemeController::class,
        'core.admin-settings'       => Controller\AdminSettingsController::class,
        'core.admin-package'        => Controller\AdminPackageController::class,
        'core.admin-mail-transport' => Controller\AdminMailTransportController::class,
        'core.error'                => Controller\ErrorController::class,
    ],
];