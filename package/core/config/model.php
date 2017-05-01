<?php
namespace Neutron\Core\Model;

return [
    'i18n_language'   => [
        'table_factory',
        ':i18n_language',
        I18nLanguage::class,
        'package/core/config/model/i18n_language.php',
    ],
    'i18n_message'    => [
        'table_factory',
        ':i18n_message',
        I18nMessage::class,
        'package/core/config/model/i18n_message.php',
    ],
    'core_role'       => [
        'table_factory',
        ':core_role',
        CoreRole::class,
        'package/core/config/model/core_role.php',
    ],
    'core_package'    => [
        'table_factory',
        ':core_package',
        CorePackage::class,
        'package/core/config/model/core_package.php',
    ],
    'mail_adapter'    => [
        'table_factory',
        ':mail_adapter',
        MailAdapter::class,
        'package/core/config/model/mail_adapter.php',
    ],
    'mail_driver'     => [
        'table_factory',
        ':mail_driver',
        MailDriver::class,
        'package/core/config/model/mail_driver.php',
    ],
    'storage_adapter' => [
        'table_factory',
        ':storage_adapter',
        StorageAdapter::class,
        'package/core/config/model/storage_adapter.php',
    ],
    'storage_driver'  => [
        'table_factory',
        ':storage_driver',
        StorageDriver::class,
        'package/core/config/model/storage_driver.php',
    ],
    'storage_file'    => [
        'table_factory',
        ':storage_file',
        StorageFile::class,
        'package/core/config/model/storage_file.php',
    ],
    'session'         => [
        'table_factory',
        ':session',
        Session::class,
        'package/core/config/model/session.php',
    ],
    'session_driver'  => [
        'table_factory',
        ':session_driver',
        SessionDriver::class,
        'package/core/config/model/session_driver.php',
    ],
    'mail_template'   => [
        'table_factory',
        ':mail_template',
        MailTemplate::class,
        'package/core/config/model/mail_template.php',
    ],
    'layout_action' => [
        'table_factory',
        ':layout_action',
        LayoutAction::class,
        'package/core/config/model/layout_action.php',
    ],
    'layout_theme'           => [
        'table_factory',
        ':layout_theme',
        LayoutTheme::class,
        'package/core/config/model/layout_theme.php',
    ],
    'layout_page' => [
        'table_factory',
        ':layout_page',
        LayoutPage::class,
        'package/core/config/model/layout_page.php',
    ],
    'layout_theme_params'    => [
        'table_factory',
        ':layout_theme_params',
        LayoutThemeParams::class,
        'package/core/config/model/layout_theme_params.php',
    ],
    'layout_component' => [
        'table_factory',
        ':layout_component',
        LayoutComponent::class,
        'package/core/config/model/layout_component.php',
    ],
    'layout_block'    => [
        'table_factory',
        ':layout_block',
        LayoutBlock::class,
        'package/core/config/model/layout_block.php',
    ],
    'layout_grid_location' => [
        'table_factory',
        ':layout_grid_location',
        LayoutGridLocation::class,
        'package/core/config/model/layout_grid_location.php',
    ],
    'layout_container_location' => [
        'table_factory',
        ':layout_container_location',
        LayoutContainerLocation::class,
        'package/core/config/model/layout_container_location.php',
    ],
    'layout_container' => [
        'table_factory',
        ':layout_container',
        LayoutContainer::class,
        'package/core/config/model/layout_container.php',
    ],
];