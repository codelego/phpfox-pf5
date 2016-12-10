<?php

namespace Neutron\Cms;


use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    public function __call($name, $arguments)
    {
        // do nothing
    }
}