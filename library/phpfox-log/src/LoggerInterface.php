<?php

namespace Phpfox\Log;

/**
 * Interface LoggerInterface
 *
 * http://www.php-fig.org/psr/psr-3/#3-psr-log-loggerinterface
 *
 * @package Phpfox\Log
 */
interface LoggerInterface
{
    /**
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function emergency($message, $context = []);

    /**
     * action must be taken immediately
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function alert($message, $context = []);

    /**
     * Write alert-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function critical($message, $context = []);

    /**
     * Write error-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function error($message, $context = []);

    /**
     * Write warning-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function warning($message, $context = []);

    /**
     * Write notice-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function notice($message, $context = []);

    /**
     * Write information-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function info($message, $context = []);

    /**
     *
     * Write debug-level messages
     *
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function debug($message, $context = []);

    /**
     *
     * Write debug-level messages
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return $this
     */
    public function log($level, $message, $context = []);
}