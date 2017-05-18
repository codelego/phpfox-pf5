<?php

namespace Phpfox\Logger;


class LogContainerFactory
{
    function factory($key = null)
    {
        if (!$key) {
            $key = 'log.main';
        }

        $parameter = _get('package.loader')->getLogParameter($key);

        $container = new LogContainer();

        if (!$parameter->get('loggers')) {
            return $container;
        }

        foreach ($parameter->get('loggers') as $logger) {
            $driver = $logger['class'];

            $container->add(new $driver ($logger['params']));
        }

        return $container;
    }
}