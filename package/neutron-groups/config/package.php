<?php

namespace Neutron\Pages;

return [
    'psr4'           => [
        'Neutron\\Group\\' => [
            'package/neutron-groups/src',
            'package/neutron-groups/test',
        ],
    ],
    'router.routes'  => [
        'profile.pages' => [
            'route'    => '<name>/groups',
            'defaults' => [
                'controller' => 'groups.profile',
                'action'     => 'browse',
            ],
        ],
    ],
    'controller.map' => [
        'group.profile' => Controller\ProfileController::class,
    ],
];