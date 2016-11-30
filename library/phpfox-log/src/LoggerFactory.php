<?php
namespace Phpfox\Log;

/**
 * Class LoggerFactory
 *
 * @package Phpfox\Log
 */
class LoggerFactory
{
    /**
     * @param $class
     * @param $options
     *
     * @return LoggerInterface
     */
    public function factory($class, $options)
    {
        $logOptions = \Phpfox::config('log.containers', $options);

        if (!$class) {
            $drivers = \Phpfox::config('log.drivers');
            $class = $drivers[$logOptions['driver']];
        }

        return new $class($logOptions);
    }
}