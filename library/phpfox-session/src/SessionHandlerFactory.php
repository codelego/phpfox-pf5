<?php

namespace Phpfox\Session;


class SessionHandlerFactory
{
    /**
     * @param string       $class
     * @param string|array $options
     *
     * @return SessionHandlerInterface
     */
    public function factory($class, $options)
    {
        if (is_string($options)) {
            $options = \Phpfox::getConfig('session.adapters', $options);
        }

        if (!$class) {
            $class = \Phpfox::getConfig('session.drivers', $options['driver']);
        }

        return new $class($options);
    }
}