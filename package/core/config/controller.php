<?php

namespace Neutron\Core\Controller;

return [
    'core.index'                  => IndexController::class,
    'core.admin-index'            => AdminIndexController::class,
    'core.admin-i18n-message'     => AdminI18nMessageController::class,
    'core.admin-i18n-locale'      => AdminI18nLocaleController::class,
    'core.admin-i18n-timezone'    => AdminI18nTimezoneController::class,
    'core.admin-i18n-currency'    => AdminI18nCurrencyController::class,
    'core.admin-i18n-settings'    => AdminI18nSettingsController::class,
    'core.admin-settings'         => AdminSettingsController::class,
    'core.admin-cache'            => AdminCacheController::class,
    'core.admin-log'              => AdminLogController::class,
    'core.admin-package'          => AdminPackageController::class,
    'core.admin-mail'             => AdminMailController::class,
    'core.admin-mail-template'    => AdminMailTemplateController::class,
    'core.admin-mail-bulk'        => AdminMailBulkController::class,
    'core.admin-layout'           => AdminLayoutPageController::class,
    'core.admin-layout-component' => AdminLayoutComponentController::class,
    'core.admin-layout-theme'     => AdminLayoutThemeController::class,
    'core.admin-layout-block'     => AdminLayoutBlockController::class,
    'core.error'                  => ErrorController::class,
    'core.admin-auth'             => AdminAuthController::class,
    'core.ajax-i18n'              => AjaxI18nController::class,
    'core.admin-status'           => AdminStatusController::class,
    'core.admin-acl'              => AdminAclController::class,
    'core.admin-storage'          => AdminStorageController::class,
];