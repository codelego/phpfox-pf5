<?php
namespace Phpfox\Messaging {

    use Phpfox\Logger\LogContainerFactory;

    return [
        'psr4' => [
            'Phpfox\\Jobs\\' => [
                'library/phpfox-jobs/src',
                'library/phpfox-jobs/test',
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
        'services'   => [
            'log.jobs'  => [LogContainerFactory::class, null,],
            'queues'    => [null, 'LocalQueueClass', 'queues'],
            'queues.01' => [null, 'AwsSQS', 'queue.01'],
        ],
    ];
}
