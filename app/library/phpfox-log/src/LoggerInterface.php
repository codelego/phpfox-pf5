<?php

namespace Phpfox\Logger;

interface LoggerInterface
{
    /**
     * @param mixed $message
     * @param array $context
     */
    public function emergency($message, $context = []);

    /**
     * action must be taken immediately
     *
     * @param mixed $message
     * @param array $context
     */
    public function alert($message, $context = []);

    /**
     * Write alert-level messages
     *
     * @param mixed $message
     * @param array $context
     *
     * @return $this
     */
    public function critical($message, $context = []);

    /**
     * Write error-level messages
     *
     * @param mixed $message
     * @param array $context
     */
    public function error($message, $context = []);

    /**
     * Write warning-level messages
     *
     * @param mixed $message
     * @param array $context
     */
    public function warning($message, $context = []);

    /**
     * Write notice-level messages
     *
     * @param mixed $message
     * @param array $context
     */
    public function notice($message, $context = []);

    /**
     * Write information-level messages
     *
     * @param mixed $message
     * @param array $context
     */
    public function info($message, $context = []);

    /**
     *
     * Write debug-level messages
     *
     * @param mixed $message
     * @param array $context
     */
    public function debug($message, $context = []);

    /**
     *
     * Write debug-level messages
     *
     * @param mixed $level
     * @param mixed $message
     * @param array $context
     */
    public function log($level, $message, $context = []);
}