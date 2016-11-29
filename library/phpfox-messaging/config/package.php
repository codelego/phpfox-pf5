<?php
namespace Phpfox\Messaging {

    use Phpfox\Log\LogContainerFactory;

    return [
        'autoload.psr4' => [
            'Phpfox\\Messaging\\' => [
                'library\phpfox-messaging\src',
                'library\phpfox-messaging\test',
            ],
        ],
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
        'service.map'      => [
            'log.jobs'  => [LogContainerFactory::class, null,],
            'queues'    => [null, 'LocalQueueClass', 'queues'],
            'queues.01' => [null, 'AwsSQS', 'queue.01'],
        ],
    ];
}
