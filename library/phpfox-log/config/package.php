<?php

namespace Phpfox\Log {

    return [
        'autoload.psr4'  => [
            'Phpfox\\Log\\' => [
                'library/phpfox-log/src',
                'library/phpfox-log/test',
            ],
        ],
        'log.drivers'    => [
            'filesystem' => FilesystemLogger::class,
            'db'         => DbLogger::class,
        ],
        'log.containers' => [
            'main.log' => [
                [
                    'driver'   => 'filesystem',
                    'filename' => 'main.log',
                ],
            ],
        ],
        'service.map'    => [
            'main.log' => [LogContainerFactory::class, null, 'main.log'],
        ],
    ];
}
