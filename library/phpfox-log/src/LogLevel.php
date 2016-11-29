<?php

namespace Phpfox\Log;

/**
 * Describe log levels
 *
 * http://www.php-fig.org/psr/psr-3/#5-psr-log-loglevel
 *
 * Define log level
 * emergency, alert, critical, error, warning, notice, info, debug
 * code number:
 * - emergency: 1
 * - alert: 2
 * - critical: 3
 * - error: 4
 * - warning: 5
 * - notice: 6
 * - info: 7
 * - debug: 8
 *
 * @package Phpfox\Log
 */
final class LogLevel
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    const NUMBER_EMERGENCY = 1;
    const NUMBER_ALERT     = 2;
    const NUMBER_CRITICAL  = 3;
    const NUMBER_ERROR     = 4;
    const NUMBER_WARNING   = 5;
    const NUMBER_NOTICE    = 6;
    const NUMBER_INFO      = 7;
    const NUMBER_DEBUG     = 8;

    public static function getNumber($level)
    {
        switch ($level) {
            case self::EMERGENCY:
            case self::NUMBER_EMERGENCY:
                return self::NUMBER_EMERGENCY;

            case self::ALERT:
            case self::NUMBER_ALERT:
                return self::NUMBER_ALERT;

            case self::CRITICAL:
            case self::NUMBER_CRITICAL:
                return self::NUMBER_CRITICAL;

            case self::ERROR:
            case self::NUMBER_ERROR:
                return self::NUMBER_ERROR;

            case self::WARNING:
            case self::NUMBER_WARNING:
                return self::NUMBER_WARNING;

            case self::NOTICE:
            case self::NUMBER_NOTICE:
                return self::NUMBER_NOTICE;

            case self::INFO:
            case self::NUMBER_INFO:
                return self::NUMBER_INFO;

            case self::DEBUG:
            case self::NUMBER_DEBUG:
                return self::NUMBER_DEBUG;

            default:
                return self::NUMBER_ERROR;
        }

    }


}