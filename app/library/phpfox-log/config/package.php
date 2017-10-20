<?php

namespace Phpfox\Logger;

return [
    'log_drivers' => [
        'files' => FilesLogger::class,
        'db'    => DbLogger::class,
    ],
    'services'    => [
        'main.log'      => [LogContainerFactory::class, 'main_log'],
        'mail.log'      => [LogContainerFactory::class, 'mail_log'],
        'debug.log'     => [LogContainerFactory::class, 'debug_log'],
        'error.handler' => [null, ErrorHandler::class],
    ],
];