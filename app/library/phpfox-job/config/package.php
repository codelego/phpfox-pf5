<?php

namespace Phpfox\Messaging;

return [
    'log.container' => [
        'jobs.log' => [
            [
                'driver'   => 'filesystem',
                'filename' => 'jobs.log',
            ],
        ],
    ],
    'job.handlers'  => [
        // class map
        'sample' => SampleJobHandler::class,
    ],
    'services'      => [
        'queues'    => [null, 'LocalQueueClass', 'queues'],
        'queues.01' => [null, 'AwsSQS', 'queue.01'],
    ],
];