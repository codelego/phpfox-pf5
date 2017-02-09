<?php
namespace Neutron\Core\Model;

return [
    'i18n_language'   => [
        'table_factory',
        ':i18n_language',
        I18nLanguage::class,
        'core/config/.meta.i18n_language.php',
    ],
    'i18n_message'    => [
        'table_factory',
        ':i18n_message',
        I18nMessage::class,
        'core/config/.meta.i18n_message.php',
    ],
    'core_role'       => [
        'table_factory',
        ':core_role',
        CoreRole::class,
        'core/config/.meta.core_role.php',
    ],
    'core_package'    => [
        'table_factory',
        ':core_package',
        CorePackage::class,
        'core/config/.meta.core_package.php',
    ],
    'core_theme'      => [
        'table_factory',
        ':core_theme',
        CoreTheme::class,
        'core/config/.meta.core_theme.php',
    ],
    'mail_adapter'    => [
        'table_factory',
        ':mail_adapter',
        MailAdapter::class,
        'core/config/.meta.mail_adapter.php',
    ],
    'mail_driver'     => [
        'table_factory',
        ':mail_driver',
        MailDriver::class,
        'core/config/.meta.mail_driver.php',
    ],
    'storage_adapter' => [
        'table_factory',
        ':storage_adapter',
        StorageAdapter::class,
        'core/config/.meta.storage_adapter.php',
    ],
    'storage_driver'  => [
        'table_factory',
        ':storage_driver',
        StorageDriver::class,
        'core/config/.meta.storage_driver.php',
    ],
    'storage_file'    => [
        'table_factory',
        ':storage_file',
        StorageFile::class,
        'core/config/.meta.storage_file.php',
    ],
];