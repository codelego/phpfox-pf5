<?php

namespace Neutron\User;

return [
    'auth.passwords' => [
        'pf5' => Auth\Pf5PasswordCompatible::class,
        'pf4' => Auth\Pf4PasswordCompatible::class,
        'se'  => Auth\SePasswordCompatible::class,
        'ow'  => Auth\OwPasswordCompatible::class,
    ],
    'services'       => [
        'user.callback'       => [null, Service\EventListener::class,],
        'user.verify_email'   => [null, Service\VerifyEmail::class],
        'user.browse'         => [null, Service\Browse::class],
        'auth.factory'        => [null, Service\AuthFactory::class],
        'user.profile_filter' => [null, Service\ProfileNameFilter::class],
    ],
    'templates'      => _get_view_map(['user' => 'neutron-users/view',]),
];