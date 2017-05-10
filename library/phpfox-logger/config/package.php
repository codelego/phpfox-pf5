<?php

namespace Phpfox\Logger;

return [
    'log.drivers'    => [
        'files' => FilesLogger::class,
        'db'    => DbLogger::class,
    ],
    'log.containers' => [
        'main.log'  => [
            ['driver' => 'files', 'filename' => 'main.log',],
        ],
        'mail.log'  => [
            ['driver' => 'files', 'filename' => 'mail.log',],
        ],
        'debug.log' => [
            ['driver' => 'files', 'filename' => 'debug.log',],
        ],
    ],
    'services'       => [
        'main.log'      => [LogContainerFactory::class, null, 'main.log'],
        'mail.log'      => [LogContainerFactory::class, null, 'mail.log'],
        'debug.log'     => [LogContainerFactory::class, null, 'debug.log'],
        'error.handler' => [null, ErrorHandler::class],
    ],
];