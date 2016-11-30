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
        $logOptions = \Phpfox::getConfig('log.containers', $options);

        if (!$class) {
            $drivers = \Phpfox::getConfig('log.drivers');
            $class = $drivers[$logOptions['driver']];
        }

        return new $class($logOptions);
    }
}