<?php

namespace Neutron\Message\Service;


use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{
    function __call($name, $arguments)
    {
        // do nothing
    }
}