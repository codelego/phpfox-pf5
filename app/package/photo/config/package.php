<?php

namespace Neutron\Photo;

return [
    'services' => [
        'photo.callback' => Service\EventListener::class,
        'photo'          => Service\photo::class,
    ],
];