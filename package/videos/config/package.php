<?php

namespace Neutron\Video;

return [
    'view.map'  => [],
    'services'  => [
        'video.callback' => [null, Service\EventListener::class],
        'videos'         => [null, Service\Videos::class],
        'video.provider' => [null, Service\Providers::class],
    ],
    'templates' => _view_map(['default' => ['video' => 'package/videos/view']]),
];