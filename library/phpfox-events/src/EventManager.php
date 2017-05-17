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
     * @return Response
     */
    public function emit($name, $target = null, $params = [])
    {

        if (empty($this->events[$name])) {
            return new Response();
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

        if (empty($this->events[$event->getName()])) {
            return $response;
        }

        try {
            foreach ($this->events[$name] as $key) {

                $result = _get($key)->{$name}($event);

                $response->push($result);

                if ($event->isStopped()) {
                    break;
                }
            }

        } catch (\Exception $exception) {
            _get('main.log')->error($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param string       $name
     * @param mixed|object $target
     * @param array        $params
     *
     * @return mixed
     */
    public function callback($name, $target = null, $params = [])
    {
        if (empty($this->events[$name])) {
            return null;
        }

        return _get($this->events[0])->{$name}(new Event($name,
            $target,
            $params));
    }

    public function clearListeners($name)
    {
        unset($this->events[$name]);
    }

    public function initialize()
    {
        if ($this->initialized) {
            return false;
        }
        $this->initialized = true;
        $this->events = _get('mvc.events.loader')->load();

        return true;
    }
}