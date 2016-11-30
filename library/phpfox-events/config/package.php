<?php
namespace Phpfox\Event;

return [
    'autoload.psr4' => [
        'Phpfox\\Event\\' => [
            'library/phpfox-events/src',
            'library/phpfox-events/test',
        ],
    ],
    'service.map'   => [
        'events' => [null, EventManager::class],
    ],
];