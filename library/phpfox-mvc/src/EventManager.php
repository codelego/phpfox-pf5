<?php

namespace Phpfox\Mvc;

class EventManager implements EventManagerInterface
{
    /**
     * @var array[]
     */
    protected $events = [];

    public function emit($event, $target = null, $params = [])
    {
        // almost case gone here.
        if (empty($this->events[$event])) {
            return null;
        }

        $event = ($event instanceof EventInterface) ? $event
            : new Event($event, $target, $params);

        return $this->trigger($event);
    }

    public function trigger(EventInterface $event)
    {
        $name = $event->getName();

        // Initial value of stop propagation flag should be false
        $event->stopPropagation(false);

        $response = new EventResponse();
        try {
            foreach ($this->events[$name] as $listener) {

                \Phpfox::getService($listener)->{$name}($event, $response);

                // If the event was asked to stop propagating, do so
                if ($event->isStopped()) {
                    $response->setStopped(true);
                    break;
                }
            }

        } catch (\Exception $exception) {
            \Phpfox::getService('events.log')->error($exception->getMessage());
        }

        return $response;
    }

    public function attach($eventName, $listener, $priority = 1)
    {
        $this->events[$eventName][((int)$priority) . '.0'][] = $listener;
        return $this;
    }

    public function detach($listener, $eventName = null)
    {
        // TODO: Implement detach() method.
    }

    public function clearListeners($eventName)
    {
        if (isset($this->events[$eventName])) {
            unset($this->events[$eventName]);
        }
        return $this;
    }
}