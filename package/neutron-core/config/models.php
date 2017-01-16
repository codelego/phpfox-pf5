<?php
namespace Neutron\Core\Model;

return [
    'i18n_language'      => [
        'table_factory',
        ':i18n_language',
        I18nLanguage::class,
        'neutron-core/config/.meta.i18n_language.php',
    ],
    'i18n_phrase'        => [
        'table_factory',
        ':i18n_phrase',
        I18nPhrase::class,
        'neutron-core/config/.meta.i18n_phrase.php',
    ],
    'authorization_role' => [
        'table_factory',
        ':authorization_role',
        AuthorizationRole::class,
        'neutron-core/config/.meta.authorization_role.php',
    ],
    'core_package'       => [
        'table_factory',
        ':core_package',
        CorePackage::class,
        'neutron-core/config/.meta.core_package.php',
    ],
    'core_theme'         => [
        'table_factory',
        ':core_theme',
        CoreTheme::class,
        'neutron-core/config/.meta.core_theme.php',
    ],
];