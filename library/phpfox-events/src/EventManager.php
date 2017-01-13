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
            foreach ($this->events[$name] as $key) {

                $result = \Phpfox::get($key)->{$name}($event);

                $response->push($result);

                if ($event->isStopped()) {
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
        $this->events = \Phpfox::build('mvc.events.loader')->load();

        return true;
    }
}