<?php

namespace Neutron\Video;

return [
    'view.map'    => [],
    'services'    => [
        'video.callback' => [null, Service\EventListener::class],
    ],
];