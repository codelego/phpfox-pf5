<?php

namespace Neutron\Video;

return [
    'view.map'  => [],
    'services'  => [
        'video.callback' => [null, Service\EventListener::class],
        'video'         => [null, Service\video::class],
        'video.provider' => [null, Service\Providers::class],
    ],
    'templates' => _view_map(['default' => ['video' => 'package/video/view']]),
];