<?php

namespace Neutron\Core\Controller;

return [
    'core.index'                  => IndexController::class,
    'core.admin-index'            => AdminIndexController::class,
    'core.admin-i18n-phrase'      => AdminI18nPhraseController::class,
    'core.admin-i18n-language'    => AdminI18nLanguageController::class,
    'core.admin-settings'         => AdminSettingsController::class,
    'core.admin-package'          => AdminPackageController::class,
    'core.admin-mail'             => AdminMailAdapterController::class,
    'core.admin-mail-driver'      => AdminMailDriverController::class,
    'core.admin-mail-template'    => AdminMailTemplateController::class,
    'core.admin-layout'           => AdminLayoutPageController::class,
    'core.admin-layout-component' => AdminLayoutComponentController::class,
    'core.admin-layout-theme'     => AdminLayoutThemeController::class,
    'core.admin-layout-block'     => AdminLayoutBlockController::class,
    'core.error'                  => ErrorController::class,
    'core.admin-auth'             => AdminAuthController::class,
    'core.ajax-i18n'              => AjaxI18nController::class,
    'core.admin-status'           => AdminStatusController::class,
    'core.admin-authorization'    => AdminAuthorizationController::class,
    'core.admin-storage'          => AdminStorageController::class,
    'core.admin-rad'              => AdminRadController::class,
];