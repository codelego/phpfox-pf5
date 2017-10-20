<?php

namespace Phpfox\Logger;


class DbLogger implements LoggerInterface
{

    /**
     * @var string
     */
    protected $model;


    /**
     * DbLogger constructor.
     *
     * - model: log to table string
     * - level:  debug, info, ...
     *
     * @param $config
     */
    public function __construct($config)
    {
        $config = array_merge(['model' => ':core_log',], $config);

        $this->model = $config['model'];
    }

    public function emergency($message, $context = [])
    {
        $this->write($this->format(LogLevel::EMERGENCY, $message, $context));
    }

    protected function write($data)
    {
        return \Phpfox::get('db')->insert($this->model, $data)->execute();
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return array
     */
    public function format($level, $message, $context = [])
    {
        if ($context) {
            $message = $this->interpolate($message, $context);
        }
        $time = date('Y-m-d H:i:s');

        return [
            'level'   => $level,
            'message' => $message,
            'created' => $time,
            'updated' => $time,
            'ip'      => isset($_SERVER['REMOTE_ADDR'])
                ? $_SERVER['REMOTE_ADDR'] : '',
        ];
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

    public function alert($message, $context = [])
    {
        $this->write($this->format(LogLevel::ALERT, $message, $context));
    }

    public function critical($message, $context = [])
    {
        $this->write($this->format(LogLevel::CRITICAL, $message, $context));
    }

    public function error($message, $context = [])
    {
        $this->write($this->format(LogLevel::ERROR, $message, $context));
    }

    public function warning($message, $context = [])
    {
        $this->write($this->format(LogLevel::WARNING, $message, $context));
    }

    public function notice($message, $context = [])
    {
        $this->write($this->format(LogLevel::CRITICAL, $message, $context));
    }

    public function info($message, $context = [])
    {
        $this->write($this->format(LogLevel::INFO, $message, $context));
    }

    public function debug($message, $context = [])
    {
        $this->write($this->format(LogLevel::DEBUG, $message, $context));
    }

    public function log($level, $message, $context = [])
    {
        $this->write($this->format($level, $message, $context));
    }
}