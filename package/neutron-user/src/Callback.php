<?php

namespace Neutron\User;


use Phpfox\Event\Event;
use Phpfox\Router\Result;

class Callback
{
    public function onFilterProfileName(Event $event)
    {
        /** @var Result $result */
        $result = $event->getTarget();

        $name = $result->get('name');

        if (!$name) {
            $event->stop(true);
            return false;
        }

        $user = \Phpfox::get('user.browse')
            ->findByUsername($name);

        if (!$user) {
            return false;
        }
        return true;
    }

    public function __call($method, $args)
    {
        // do nothing
    }
}