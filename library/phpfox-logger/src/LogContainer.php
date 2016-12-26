<?php

namespace Phpfox\Logger;

class LogContainer implements LogContainerInterface
{
    /**
     * @var LoggerInterface[]
     */
    protected $loggers;

    public function add(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    public function emergency($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->emergency($message, $context);
        }

    }

    public function alert($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->alert($message, $context);
        }

    }

    public function critical($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->critical($message, $context);
        }

    }

    public function error($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->error($message, $context);
        }

    }

    public function warning($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->warning($message, $context);
        }

    }

    public function notice($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->notice($message, $context);
        }

    }

    public function info($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->info($message, $context);
        }

    }

    public function debug($message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->debug($message, $context);
        }

    }


    public function log($level, $message, $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }

    }
}