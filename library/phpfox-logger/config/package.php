<?php

namespace Phpfox\Logger;

return [
    'psr4'  => [
        'Phpfox\\Logger\\' => [
            'library/phpfox-logger/src',
            'library/phpfox-logger/test',
        ],
    ],
    'log.drivers'    => [
        'files' => FilesLogger::class,
        'db'    => DbLogger::class,
    ],
    'log.containers' => [
        'main.log' => [
            ['driver' => 'files', 'filename' => 'main.log',],
        ],
        'dev.log'  => [
            ['driver' => 'files', 'filename' => 'dev.log',],
        ],
    ],
    'service.map'    => [
        'main.log' => [LogContainerFactory::class, null, 'main.log'],
        'dev.log'  => [LogContainerFactory::class, null, 'dev.log'],
    ],
];