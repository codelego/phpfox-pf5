<?php

namespace Neutron\Photo;

return [
    'services' => [
        'photo.callback' => Service\EventListener::class,
        'photos'         => Service\Photos::class,
    ],
];