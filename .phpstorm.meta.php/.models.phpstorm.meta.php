<?php

namespace PHPSTORM_META {

    override(\Phpfox::findById(0), map([
        'auth_password'      => \Neutron\User\Model\AuthPassword::class,
        'auth_remote'        => \Neutron\User\Model\AuthRemote::class,
        'auth_token'         => \Neutron\User\Model\AuthToken::class,
        'authorization_role' => \Neutron\Core\Model\AuthorizationRole::class,
        'core_package'       => \Neutron\Core\Model\CorePackage::class,
        'core_theme'         => \Neutron\Core\Model\CoreTheme::class,
        'i18n_language'      => \Neutron\Core\Model\I18nLanguage::class,
        'i18n_phrase'        => \Neutron\Core\Model\I18nPhrase::class,
        'pages'              => \Neutron\Pages\Model\Pages::class,
        'user'               => \Neutron\User\Model\User::class,
    ]));
}