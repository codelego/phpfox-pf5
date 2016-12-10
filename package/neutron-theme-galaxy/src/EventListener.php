<?php

namespace Neutron\ThemeGalaxy;


use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    public function __call($name, $arguments)
    {
        // do nothing
    }
}