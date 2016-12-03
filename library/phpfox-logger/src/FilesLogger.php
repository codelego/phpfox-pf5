<?php

namespace Phpfox\Logger;

class FilesLogger implements LoggerInterface
{
    use LoggerTrait;

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
     * FilesystemLogger constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $config = array_merge([
            'filename' => 'main.log',
            'level'    => 'debug',
        ], (array)$config);

        $directory = realpath(__DIR__ . '/../../../data');


        $this->filename = $directory . DS . 'log' . DS . $config['filename'];

        if (!file_exists($this->filename)) {
            if (!is_dir($dir = dirname($this->filename))
                && mkdir($dir, true, $this->directoryPermission)
            ) {
                @file_put_contents($this->filename,
                    '# create by FilesLogger ' . PHP_EOL);
                @chmod($this->filename, $this->filePermission);
            }
        }

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