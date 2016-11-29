<?php

namespace Phpfox\EventManager {

    return [
        'autoload.psr4' => [
            'Phpfox\\EventManager\\' => [
                'library\phpfox-events\src',
                'library\phpfox-events\test',
            ],
        ],
        'service.map'   => [
            'events' => [null, EventManager::class,],
        ],
        'events'        => [],
    ];
}

