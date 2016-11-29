<?php

namespace Phpfox\Messaging;

class LocalQueuesService implements QueuesServiceInterface
{

    /**
     * @var string
     */
    protected $name = 'phpfox';

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    public function addMessage(
        $message,
        $timeout = 0,
        $expiresAfter = 0,
        $delayIn = 0
    ) {
    }

    public function deleteMessage($reservationId)
    {
    }

    public function getMessages($limit = 5)
    {
    }

    public function getMessage()
    {
        $item = $this->getClient()->getMessage();

        if (!$item) {
            return null;
        }

        return [
            'queueName'     => $this->getName(),
            'messageId'     => $item['message_id'],
            'messageBody'   => $item['message_data'],
            'reservationId' => $item['message_id'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function bury()
    {
        // TODO: Implement bury() method.
    }

    /**
     * {@inheritdoc}
     */
    public function kick()
    {
        // TODO: Implement kick() method.
    }


    public function release()
    {
        // try to close database connection example.
    }
}