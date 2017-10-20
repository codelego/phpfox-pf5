<?php

namespace Phpfox\Logger;


class LogContainerFactory
{
    function factory($key = null)
    {
        if (!$key) {
            $key = 'main.log';
        }

        $parameter = _get('package.loader')->getLogParameter($key);

        $container = new LogContainer();

        foreach ($parameter->get('loggers') as $logger) {
            $driverClass = $logger['class'];
            if (!class_exists($driverClass)) {
                continue;
            }
            $container->add(new $driverClass ($logger));
        }
        return $container;
    }
}