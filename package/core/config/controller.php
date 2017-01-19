<?php
namespace Neutron\Core\Controller;

return [
    'core.index'                => IndexController::class,
    'core.admin-index'          => AdminIndexController::class,
    'core.admin-i18n'           => AdminI18nController::class,
    'core.admin-theme'          => AdminThemeController::class,
    'core.admin-settings'       => AdminSettingsController::class,
    'core.admin-package'        => AdminPackageController::class,
    'core.admin-mail-transport' => AdminMailController::class,
    'core.error'                => ErrorController::class,
    'core.admin-auth'           => AdminAuthController::class,
    'core.ajax-i18n'            => AjaxI18nController::class,
    'core.admin-status'         => AdminStatusController::class,
    'core.admin-authorization'  => AdminAuthorizationController::class,
];