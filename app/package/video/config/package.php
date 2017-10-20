<?php

namespace Neutron\Video;

return [
    'services'  => [
        'video.callback' => [null, Service\EventListener::class],
        'video'          => [null, Service\VideoManager::class],
        'video.provider' => [null, Service\ProviderManager::class],
    ],
];