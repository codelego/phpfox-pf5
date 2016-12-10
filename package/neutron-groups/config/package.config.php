<?php

namespace Neutron\Group;

return [
    'psr4'           => [
        'Neutron\\Group\\' => [
            'package/neutron-groups/src',
            'package/neutron-groups/test',
        ],
    ],
    'routes'  => [
        'profile.pages' => [
            'route'    => '<name>/groups',
            'defaults' => [
                'controller' => 'groups.profile',
                'action'     => 'browse',
            ],
        ],
    ],
    'controllers' => [
        'group.profile' => Controller\ProfileController::class,
    ],
    'services'    => [
        'group.callback' => [null, EventListener::class],
    ],
];