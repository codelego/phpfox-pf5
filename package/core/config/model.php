<?php

namespace Neutron\Core\Model;

return [
    'i18n_locale'         => [
        'table_factory',
        ':i18n_locale',
        I18nLocale::class,
        'package/core/config/model/i18n_locale.php',
    ],
    'i18n_message'        => [
        'table_factory',
        ':i18n_message',
        I18nMessage::class,
        'package/core/config/model/i18n_message.php',
    ],
    'i18n_timezone'       => [
        'table_factory',
        ':i18n_timezone',
        I18nTimezone::class,
        'package/core/config/model/i18n_timezone.php',
    ],
    'i18n_currency'       => [
        'table_factory',
        ':i18n_currency',
        I18nCurrency::class,
        'package/core/config/model/i18n_currency.php',
    ],
    'acl_level'            => [
        'table_factory',
        ':acl_level',
        AclLevel::class,
        'package/core/config/model/acl_level.php',
    ],
    'acl_form'            => [
        'table_factory',
        ':acl_form',
        AclForm::class,
        'package/core/config/model/acl_form.php',
    ],
    'acl_action'  => [
        'table_factory',
        ':acl_action',
        AclAction::class,
        'package/core/config/model/acl_action.php',
    ],
    'acl_value'   => [
        'table_factory',
        ':acl_value',
        AclValue::class,
        'package/core/config/model/acl_value.php',
    ],
    'core_package'        => [
        'table_factory',
        ':core_package',
        CorePackage::class,
        'package/core/config/model/core_package.php',
    ],
    'storage_adapter'     => [
        'table_factory',
        ':storage_adapter',
        StorageAdapter::class,
        'package/core/config/model/storage_adapter.php',
    ],
    'storage_file'        => [
        'table_factory',
        ':storage_file',
        StorageFile::class,
        'package/core/config/model/storage_file.php',
    ],
    'session'             => [
        'table_factory',
        ':session',
        Session::class,
        'package/core/config/model/session.php',
    ],
    'mail_template'       => [
        'table_factory',
        ':mail_template',
        MailTemplate::class,
        'package/core/config/model/mail_template.php',
    ],
    'setting_value'  => [
        'table_factory',
        ':setting_value',
        SettingValue::class,
        'package/core/config/model/setting_value.php',
    ],
    'layout_action'       => [
        'table_factory',
        ':layout_action',
        LayoutAction::class,
        'package/core/config/model/layout_action.php',
    ],
    'layout_theme'        => [
        'table_factory',
        ':layout_theme',
        LayoutTheme::class,
        'package/core/config/model/layout_theme.php',
    ],
    'layout_page'         => [
        'table_factory',
        ':layout_page',
        LayoutPage::class,
        'package/core/config/model/layout_page.php',
    ],
    'layout_theme_params' => [
        'table_factory',
        ':layout_theme_params',
        LayoutThemeParams::class,
        'package/core/config/model/layout_theme_params.php',
    ],
    'layout_component'    => [
        'table_factory',
        ':layout_component',
        LayoutComponent::class,
        'package/core/config/model/layout_component.php',
    ],
    'layout_block'        => [
        'table_factory',
        ':layout_block',
        LayoutBlock::class,
        'package/core/config/model/layout_block.php',
    ],
    'layout_grid'         => [
        'table_factory',
        ':layout_grid',
        LayoutGrid::class,
        'package/core/config/model/layout_grid.php',
    ],
    'layout_location'     => [
        'table_factory',
        ':layout_location',
        LayoutLocation::class,
        'package/core/config/model/layout_location.php',
    ],
    'layout_container'    => [
        'table_factory',
        ':layout_container',
        LayoutContainer::class,
        'package/core/config/model/layout_container.php',
    ],
    'core_driver'         => [
        'table_factory',
        ':core_driver',
        CoreDriver::class,
        'package/core/config/model/core_driver.php',
    ],
    'core_adapter'        => [
        'table_factory',
        ':core_adapter',
        CoreAdapter::class,
        'package/core/config/model/core_adapter.php',
    ],
    'setting_form'   => [
        'table_factory',
        ':setting_form',
        SettingForm::class,
        'package/core/config/model/setting_form.php',
    ],
];