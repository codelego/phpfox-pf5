<?php

namespace Phpfox\Log;


/**
 * Class LoggerTrait
 *
 * @package Phpfox\Log
 */
trait LoggerTrait
{
    /**
     * Default accept level is maximum
     *
     * @var
     */
    protected $level = 4;

    public function setLevel($level)
    {
        $this->level = LogLevel::getNumber(strtolower($level));
    }

    public function emergency($message, $context = [])
    {
        $this->write($this->format(LogLevel::EMERGENCY, $message, $context));
        return $this;
    }

    public function alert($message, $context = [])
    {
        if ($this->accept(LogLevel::ALERT)) {
            $this->write($this->format(LogLevel::ALERT, $message, $context));
        }

        return $this;
    }

    /**
     * @param mixed $level Available values EMERGENCY, ALERT, CRITICAL, ERROR,
     *                     WARNING, NOTICE, INFO, DEBUG
     *
     * @return bool
     */
    public function accept($level)
    {
        return LogLevel::getNumber($level) <= $this->level;
    }

    public function critical($message, $context = [])
    {
        if ($this->accept(LogLevel::CRITICAL)) {
            $this->write($this->format(LogLevel::CRITICAL, $message, $context));
        }

        return $this;
    }

    public function error($message, $context = [])
    {
        if ($this->accept(LogLevel::ERROR)) {
            $this->write($this->format(LogLevel::ERROR, $message, $context));
        }
        return $this;
    }

    public function warning($message, $context = [])
    {
        if ($this->accept(LogLevel::WARNING)) {
            $this->write($this->format(LogLevel::WARNING, $message, $context));
        }
        return $this;
    }

    public function notice($message, $context = [])
    {
        if ($this->accept(LogLevel::CRITICAL)) {
            $this->write($this->format(LogLevel::CRITICAL, $message, $context));
        }
        return $this;
    }

    public function info($message, $context = [])
    {
        if ($this->accept(LogLevel::INFO)) {
            $this->write($this->format(LogLevel::INFO, $message, $context));
        }
        return $this;
    }

    public function debug($message, $context = [])
    {
        if ($this->accept(LogLevel::DEBUG)) {
            $this->write($this->format(LogLevel::DEBUG, $message, $context));
        }
        return $this;
    }

    public function log($level, $message, $context = [])
    {
        if ($this->accept(LogLevel::DEBUG)) {
            $this->write($this->format($level, $message, $context));
        }
        return $this;
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    protected function interpolate($message, $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }
}