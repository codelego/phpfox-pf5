<?php

namespace Neutron\Photo;

return [
    'psr4'     => [
        'Neutron\\Photo\\' => [
            'package/neutron-photo/src',
            'package/neutron-photo/test',
        ],
    ],
    'services' => [
        'photo.callback' => Service\EventListener::class,
    ],
];