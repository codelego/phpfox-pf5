<?php

namespace Phpfox\Mvc;

interface EventManagerInterface
{
    /**
     * Attaches a listener to an event
     *
     * @param string   $event    the event to attach too
     * @param callable $callback a callable function
     * @param int      $priority the priority at which the $callback executed
     *
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = 0);

    /**
     * Detaches a listener from an event
     *
     * @param string   $event    the event to attach too
     * @param callable $callback a callable function
     *
     * @return bool true on success false on failure
     */
    public function detach($event, $callback);

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     *
     * @return void
     */
    public function clearListeners($event);

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param  string $event
     * @param  mixed  $target
     * @param  mixed  $argv
     *
     * @return mixed
     */
    public function emit($event, $target = null, $argv = []);

    /**
     * @param EventInterface $event
     *
     * @return EventResponse
     */
    public function trigger(EventInterface $event);
}