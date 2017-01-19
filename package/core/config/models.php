<?php
namespace Neutron\Core\Model;

return [
    'i18n_language' => [
        'table_factory',
        ':i18n_language',
        I18nLanguage::class,
        'core/config/.meta.i18n_language.php',
    ],
    'i18n_phrase'   => [
        'table_factory',
        ':i18n_phrase',
        I18nPhrase::class,
        'core/config/.meta.i18n_phrase.php',
    ],
    'core_role'     => [
        'table_factory',
        ':authorization_role',
        CoreRole::class,
        'core/config/.meta.core_role.php',
    ],
    'core_package'  => [
        'table_factory',
        ':core_package',
        CorePackage::class,
        'core/config/.meta.core_package.php',
    ],
    'core_theme'    => [
        'table_factory',
        ':core_theme',
        CoreTheme::class,
        'core/config/.meta.core_theme.php',
    ],
];