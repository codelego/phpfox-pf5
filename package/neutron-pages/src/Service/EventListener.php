<?php
namespace Neutron\Pages\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{


    function __call($name, $arguments)
    {
        // do nothings
    }
}