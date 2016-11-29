<?php

namespace Phpfox\Log{

    return [
        'autoload.psr4' => [
            'Phpfox\\Log\\' => [
                'library\phpfox-log\src',
                'library\phpfox-log\test',
            ],
        ],
        'log.drivers'    => [
            'filesystem' => FilesystemLogger::class,
            'db'         => DbLogger::class,
        ],
        'log.containers' => [
            'log.main' => [
                [
                    'driver'   => 'filesystem',
                    'filename' => 'main.log',
                ],
            ],
        ],
        'service.map'       => [
            'log.main' => [LogContainerFactory::class, null, 'log.main'],
        ],
    ];
}
