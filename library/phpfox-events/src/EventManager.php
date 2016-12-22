<?php

namespace Phpfox\Event;

class EventManager
{
    /**
     * @var array[]
     */
    protected $events = [];

    /**
     * @var bool
     */
    protected $initialized = false;

    /**
     * @param string      $name
     * @param null|object $target
     * @param array|null  $params
     *
     * @return null|Response
     */
    public function emit($name, $target = null, $params = [])
    {
        if (empty($this->events[$name])) {
            return null;
        }

        return $this->trigger(new Event($name, $target, $params));
    }

    /**
     * @param Event $event
     *
     * @return Response
     */
    public function trigger(Event $event)
    {
        $name = $event->getName();

        // Initial value of stop propagation flag should be false
        $event->stop(false);

        $response = new Response();
        try {
            foreach ($this->events[$name] as $listener) {

                $result = \Phpfox::get($listener)->{$name}($event);

                $response->push($result);

                // If the event was asked to stop propagating, do so
                if ($event->isStopped()) {
                    $response->setStopped(true);
                    break;
                }
            }

        } catch (\Exception $exception) {
            \Phpfox::get('main.log')->error($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param       $name
     * @param null  $target
     * @param array $params
     *
     * @return mixed
     */
    public function callback($name, $target = null, $params = [])
    {
        if (empty($this->events[$name])) {
            return null;
        }

        return \Phpfox::get($this->events[0])->{$name}(new Event($name,
            $target,
            $params));
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

    public function initialize()
    {
        if ($this->initialized) {
            return;
        }
        $this->initialized = true;
        $this->events = \Phpfox::build('mvc.events.loader')->load();
    }
}