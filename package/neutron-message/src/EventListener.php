<?php

namespace Neutron\Message;


use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{
    function __call($name, $arguments)
    {
        // do nothing
    }
}