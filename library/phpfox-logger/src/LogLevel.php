<?php

namespace Phpfox\Logger;

/**
 * Describe log levels
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

    const EMERGENCY_NUMBER = 1;
    const ALERT_NUMBER     = 2;
    const CRITICAL_NUMBER  = 3;
    const ERROR_NUMBER     = 4;
    const WARNING_NUMBER   = 5;
    const NOTICE_NUMBER    = 6;
    const INFO_NUMBER      = 7;
    const DEBUG_NUMBER     = 8;

    public static function getNumber($level)
    {
        switch ($level) {
            case self::EMERGENCY:
            case self::EMERGENCY_NUMBER:
                return self::EMERGENCY_NUMBER;

            case self::ALERT:
            case self::ALERT_NUMBER:
                return self::ALERT_NUMBER;

            case self::CRITICAL:
            case self::CRITICAL_NUMBER:
                return self::CRITICAL_NUMBER;

            case self::ERROR:
            case self::ERROR_NUMBER:
                return self::ERROR_NUMBER;

            case self::WARNING:
            case self::WARNING_NUMBER:
                return self::WARNING_NUMBER;

            case self::NOTICE:
            case self::NOTICE_NUMBER:
                return self::NOTICE_NUMBER;

            case self::INFO:
            case self::INFO_NUMBER:
                return self::INFO_NUMBER;

            case self::DEBUG:
            case self::DEBUG_NUMBER:
                return self::DEBUG_NUMBER;

            default:
                return self::ERROR_NUMBER;
        }

    }
}