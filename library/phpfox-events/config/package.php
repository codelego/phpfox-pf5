<?php

namespace Phpfox\Event;

return [
    'psr4'        => [
        'Phpfox\\Event\\' => [
            'library/phpfox-events/src',
            'library/phpfox-events/test',
        ],
    ],
    'service.map' => [
        'mvc.events'        => [null, EventManager::class],
        'mvc.events.loader' => null,
    ],
];