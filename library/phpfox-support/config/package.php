<?php

namespace Phpfox\Support;

return [
    'services' => [
        'image'      => [null, InterventionImageManager::class],
        'mvc.events' => [null, EventManager::class],
        'registry'   => [null, Registry::class],
    ],
];