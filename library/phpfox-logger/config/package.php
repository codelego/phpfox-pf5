<?php

namespace Phpfox\Logger;

return [
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
    'services'       => [
        'main.log' => [LogContainerFactory::class, null, 'main.log'],
        'dev.log'  => [LogContainerFactory::class, null, 'dev.log'],
    ],
];