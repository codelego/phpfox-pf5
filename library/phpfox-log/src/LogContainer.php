<?php

namespace Phpfox\Log;

/**
 * Class LogContainer
 *
 * @package Phpfox\Log
 */
class LogContainer implements LogContainerInterface
{
    /**
     * @var LoggerInterface[]
     */
    protected $loggers;

    public function add(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
        return $this;
    }

    public function emergency($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->emergency($message, $context);
        }
        return $this;
    }

    public function alert($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->alert($message, $context);
        }
        return $this;
    }

    public function critical($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->critical($message, $context);
        }
        return $this;
    }

    public function error($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->error($message, $context);
        }
        return $this;
    }

    public function warning($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->warning($message, $context);
        }
        return $this;
    }

    public function notice($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->notice($message, $context);
        }
        return $this;
    }

    public function info($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->info($message, $context);
        }
        return $this;
    }

    public function debug($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->debug($message, $context);
        }
        return $this;
    }


    public function log($level, $message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
        return $this;
    }
}