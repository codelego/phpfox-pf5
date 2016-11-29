<?php
namespace Phpfox\Messaging;

/**
 * Interface QueuesServiceInterface
 *
 * @package Phpfox\JobQueues
 */
interface QueuesServiceInterface
{
    /**
     * Get queue name
     *
     * @return string
     */
    public function getName();

    /**
     * Adds a job to a queue ready for a worker
     *
     * @param string $message
     * @param int    $timeout
     * @param int    $expiresAfter
     * @param int    $delayIn
     *
     * @return bool
     */
    public function addMessage(
        $message,
        $timeout = 0,
        $expiresAfter = 0,
        $delayIn = 0
    );

    /**
     * Marks a job as completed and removes it from the queue
     *
     * @param $reservationId
     *
     * @return bool
     */
    public function deleteMessage($reservationId);

    /**
     * Delivers a number of jobs to a worker and locks it from being delivered
     * to another worker
     *
     * @param int $limit
     *
     * @return array [[
     * messageId     => string, // identity of message
     * messageBody   => string, // json encoded string contain [job: string,
     * data: array ] reservationId => string, // Use this value to manupluate
     * task.
     * ]]
     */
    public function getMessages($limit = 5);

    /**
     * Delivers a single job to a worker and locks it from being delivered to
     * another worker
     *
     * @return array [
     * messageId     => string, // identity of message
     * messageBody   => string, // json encoded string contain [job: string,
     * data: array ] reservationId => string, // Use this value to manupluate
     * task.
     * ]]
     */
    public function getMessage();

    /**
     * Puts a job in a failed state.
     * The job cannot be reprocessed until it is manually kicked back into the
     * queue
     */
    public function bury();

    /**
     * Returns a previously buried job to the queue ready for workers to pick up
     */
    public function kick();

    /**
     * Free resource
     * example close connection to queues service
     */
    public function release();
}