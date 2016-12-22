<?php

namespace Neutron\User\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{



    public function __call($method, $args)
    {
        // do nothing
    }
}