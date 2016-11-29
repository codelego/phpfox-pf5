<?php

namespace Phpfox\EventManager;

/**
 * Class EventManager
 *
 * @package Phpfox\EventManager
 */
/**
 * Class EventManager
 *
 * @package Phpfox\EventManager
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var EventManager
     */
    private static $singleton;
    /**
     *
     * Subscribed events and their listeners
     *
     * [
     *    'onItemStart': 'ListenerClassName',
     * ]
     *
     * @var array[]
     */
    protected $events = [];

    public static function instance()
    {
        if (null == self::$singleton) {
            self::$singleton = new static();
            self::$singleton->reset();
        }
        return self::$singleton;

    }

    public function reset()
    {
        $this->events = config('events');
    }

    public function trigger($event, $target = null, $params = [])
    {
        if (is_string($event) && empty($this->events[$event])) {
            return null;
        }

        $event = ($event instanceof EventInterface) ? $event
            : new Event($event, $target, $params);

        return $this->triggerListeners($event);
    }

    public function triggerListeners(EventInterface $event)
    {
        $name = $event->getName();

        // Initial value of stop propagation flag should be false
        $event->stopPropagation(false);

        $response = new Response();

        foreach ($this->events[$name] as $listener) {

            service($listener)->{$name}($event, $response);

            // If the event was asked to stop propagating, do so
            if ($event->isPropagationStopped()) {
                $response->setStopped(true);
                break;
            }
        }

        return $response;
    }

    public function triggerEvent(EventInterface $event)
    {
        if (empty($this->events[$event->getName()])) {
            return null;
        }

        return $this->triggerListeners($event);
    }

    public function triggerUntil(
        $callback,
        $target = null,
        $eventName,
        $argv = []
    ) {
        // TODO: Implement triggerUntil() method.
    }

    public function triggerEventUntil($callback, EventInterface $event)
    {
        // TODO: Implement triggerEventUntil() method.
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