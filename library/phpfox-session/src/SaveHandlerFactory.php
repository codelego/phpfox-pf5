<?php

namespace Phpfox\Session;


class SaveHandlerFactory
{
    /**
     * @param string       $class
     * @param string|array $options
     *
     * @return SaveHandlerInterface
     */
    public function factory($class, $options)
    {
        if (is_string($options)) {
            $options = config('session.adapters', $options);
        }

        if (!$class) {
            $class = config('session.drivers', $options['driver']);
        }

        return new $class($options);
    }
}