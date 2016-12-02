<?php

namespace Phpfox\Mvc;

class MvcEventManager
{
    /**
     * @var array[]
     */
    protected $events = [];

    public function emit($name, $target = null, $params = [])
    {
        if (empty($this->events[$name])) {
            return null;
        }

        return $this->trigger(new MvcEvent($name, $target, $params));
    }

    public function callback($name, $target = null, $params = [])
    {
        if (empty($this->events[$name])) {
            return null;
        }

        return \Phpfox::get($this->events[0])->{$name}(new MvcEvent($name, $target,
            $params));
    }

    public function trigger(MvcEvent $event)
    {
        $name = $event->getName();

        // Initial value of stop propagation flag should be false
        $event->stopPropagation(false);

        $response = new MvcEventResponse();
        try {
            foreach ($this->events[$name] as $listener) {

                \Phpfox::get($listener)->{$name}($event, $response);

                // If the event was asked to stop propagating, do so
                if ($event->isStopped()) {
                    $response->setStopped(true);
                    break;
                }
            }

        } catch (\Exception $exception) {
            \Phpfox::get('events.log')->error($exception->getMessage());
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