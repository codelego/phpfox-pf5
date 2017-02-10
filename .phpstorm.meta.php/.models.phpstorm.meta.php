<?php

namespace PHPSTORM_META {

    override(\Phpfox::findById(0), map([
        'auth_password'      => \Neutron\User\Model\AuthPassword::class,
        'auth_remote'        => \Neutron\User\Model\AuthRemote::class,
        'auth_token'         => \Neutron\User\Model\AuthToken::class,
        'contact_department' => \Neutron\Contact\Model\Department::class,
        'core_package'       => \Neutron\Core\Model\CorePackage::class,
        'core_role'          => \Neutron\Core\Model\CoreRole::class,
        'core_theme'         => \Neutron\Core\Model\CoreTheme::class,
        'i18n_language'      => \Neutron\Core\Model\I18nLanguage::class,
        'i18n_message'       => \Neutron\Core\Model\I18nMessage::class,
        'mail_adapter'       => \Neutron\Core\Model\MailAdapter::class,
        'mail_driver'        => \Neutron\Core\Model\MailDriver::class,
        'pages'              => \Neutron\Pages\Model\Pages::class,
        'report'             => \Neutron\Report\Model\Report::class,
        'report_category'    => \Neutron\Report\Model\Category::class,
        'user'               => \Neutron\User\Model\User::class,
        'user_auth_history'  => \Neutron\User\Model\AuthHistory::class,
        'video'              => \Neutron\Video\Model\Video::class,
    ]));
}