<?php

namespace Phpfox\Kernel;

class EventManager
{
    /**
     * @var Parameters
     */
    protected $events;

    /**
     * @var bool
     */
    protected $initialized = false;

    public function __construct()
    {
        $this->events = new Parameters();
    }


    /**
     * @param Event $event
     *
     * @return EventResponse
     */
    public function trigger(Event $event)
    {
        $name = $event->getName();
        $response = new EventResponse();

        // Initial value of stop propagation flag should be false
        if (empty($this->events->has($name))) {
            return $response;
        }
        foreach ($this->events->get($name) as $service) {
            try {
                _get($service)->{$name}($event, $response);

                if ($event->isStopped()) {
                    break;
                }
            } catch (\Exception $exception) {
                _get('main.log')->error($exception->getMessage());
            }
        }

        return $response;
    }

    /**
     * @param Event $event
     *
     * @return EventResponse
     */
    public function triggerUntil(Event $event)
    {
        $name = $event->getName();
        $response = new EventResponse();
        if (null != ($first = $this->events->item($name, '_0'))) {
            _get($first)->{$name}($event, $response);
        }
        return $response;
    }

    public function clearListeners($name)
    {
        $this->events->delete($name);
    }

    public function initialize()
    {
        if ($this->initialized) {
            return false;
        }
        $this->initialized = true;
        $this->events = _get('package.loader')->getEventParameters();

        return true;
    }
}