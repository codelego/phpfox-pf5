<?php

namespace Phpfox\Logger;

class FilesLogger implements LoggerInterface
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * @var int
     */
    protected $directoryPermission = 0777;

    /**
     * @var int
     */
    protected $filePermission = 0777;

    /**
     * log file size limit
     *
     * @var int
     */
    protected $limit = 10485760;

    /**
     * FilesystemLogger constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $config = array_merge(['filename' => 'main.log',], $config);

        $this->filename = PHPFOX_LOG_DIR . $config['filename'];

        if (file_exists($this->filename) and filesize($this->filename)
            > $this->limit
        ) {
            @rename($this->filename, $this->filename . '.' . time());
        }

        if (!file_exists($this->filename)) {
            if (!is_dir($dir = dirname($this->filename))
                and mkdir($dir, $this->directoryPermission, true)
            ) {
                chmod($dir, $this->directoryPermission);
            }
            @file_put_contents($this->filename,
                '#FilesLogger ' . date('Y-m-d H:i:s') . PHP_EOL);
            @chmod($this->filename, $this->filePermission);
        }
    }

    public function emergency($message, $context = [])
    {
        $this->write($this->format(LogLevel::EMERGENCY, $message, $context));
    }

    protected function write($message)
    {
        @file_put_contents($this->filename, (string)$message, FILE_APPEND);
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    public function format($level, $message, $context = [])
    {
        if ($context) {
            $message = $this->interpolate($message, $context);
        }
        return $level . ': ' . @date('Y-m-d H:i:s') . PHP_EOL . $message
            . PHP_EOL . PHP_EOL . PHP_EOL;
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