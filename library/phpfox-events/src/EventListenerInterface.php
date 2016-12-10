<?php

namespace Phpfox\Event;


interface EventListenerInterface
{
    /**
     * Event listener should implement this method to ensure all method call
     * is not break parent control.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed|null
     */
    function __call($name, $arguments);
}