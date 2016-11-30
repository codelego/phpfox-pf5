<?php

namespace Phpfox\Messaging;

/**
 * Class Worker
 *
 * @package Phpfox\Messaging
 */
class Worker
{
    /**
     * @var string
     */
    protected $queueName;

    /**
     * @var int
     */
    protected $maxNumberOfJobs = 5;

    /**
     * Worker constructor.
     *
     * @param $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
    }

    public function run()
    {

    }
}