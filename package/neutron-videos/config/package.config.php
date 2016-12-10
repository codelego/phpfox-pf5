<?php

namespace Neutron\Video;

return [
    'psr4'        => [
        'Neutron\\Video\\' => [
            'package/neutron-videos/src',
            'package/neutron-videos/test',
        ],
    ],
    'routes'      => [],
    'view.map'    => [],
    'controllers' => [
        'video.index' => Controller\IndexController::class,
    ],
    'services'    => [
        'video.callback' => [null, Service\EventListener::class],
    ],
];