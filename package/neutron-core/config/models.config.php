<?php
namespace Neutron\Core\Model;

return [
    'i18n_language' => [
        'table_factory',
        ':i18n_language',
        I18nLanguage::class,
        'neutron-core/config/.meta.i18n_language.php',
    ],
    'i18n_phrase'   => [
        'table_factory',
        ':i18n_phrase',
        I18nPhrase::class,
        'neutron-core/config/.meta.i18n_phrase.php',
    ],
];