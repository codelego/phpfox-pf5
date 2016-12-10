<?php

namespace PHPSTORM_META {

    override(\Phpfox::findById(0), map([
        'user'          => \Neutron\User\Model\User::class,
        'auth_token'    => \Neutron\User\Model\AuthToken::class,
        'auth_password' => \Neutron\User\Model\AuthPassword::class,
        'auth_remote'   => \Neutron\User\Model\AuthRemote::class,
    ]));

    override(\Phpfox::get(0), map([
        'pages.browse'   => \Neutron\Pages\Service\Browse::class,
        'pages.callback' => \Neutron\Pages\Service\Callback::class,
        'user.browse'    => \Neutron\User\Service\Browse::class,
        'user.callback'  => \Neutron\User\Service\Callback::class,
    ]));
}