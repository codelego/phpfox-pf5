<?php
namespace Phpfox\Logger;

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
        $logOptions = \Phpfox::getParam('log.containers', $options);

        if (!$class) {
            $class = \Phpfox::getParam('log.drivers', $logOptions['driver']);
        }

        return new $class($logOptions);
    }
}