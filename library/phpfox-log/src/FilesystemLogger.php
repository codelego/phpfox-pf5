<?php

namespace Phpfox\Log;

/**
 * Class FilesystemWriter
 *
 * @package Phpfox\Log
 */
class FilesystemLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    protected $filename;

    /**
     * FilesystemLogger constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $config = array_merge([
            'filename' => 'main.log',
            'level'    => '*',
        ], (array)$config);

        $directory = realpath(__DIR__ . '/../../../../data/log');

        $this->filename = $directory . DS . $config['filename'];

        $this->setLevel($config['level']);
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
        return $level . ': ' . date('Y-m-d H:i:s') . PHP_EOL . $message
            . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    protected function write($message)
    {
        file_put_contents($this->filename, (string)$message, FILE_APPEND);
    }
}