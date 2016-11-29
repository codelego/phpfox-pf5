<?php

namespace Phpfox\Log;


class LogContainerFactory
{
    function factory($class = null, $key = null)
    {
        if (!$class) {
            ;
        }

        if (!$key) {
            $key = 'default';
        }

        $drivers = config('log.drivers');
        $containers = config('log.containers');
        $loggerOptions = $containers[$key];

        $container = new LogContainer();

        foreach ($loggerOptions as $loggerOption) {
            $driver = $drivers[$loggerOption['driver']];
            $container->add(new $driver($loggerOption));
        }
        return $container;
    }
}