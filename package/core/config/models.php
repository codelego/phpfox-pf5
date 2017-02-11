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
    'core_theme'      => [
        'table_factory',
        ':core_theme',
        CoreTheme::class,
        'package/core/config/model/core_theme.php',
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
];