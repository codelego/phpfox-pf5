<?php

namespace Phpfox\Log;


class DbLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    protected $model;

    /**
     * DbLogger constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $config = array_merge([
            'model' => '',
            'level' => 'debug',
        ], (array)$config);

        $this->model = $config['model'];
        $this->setLevel($config['level']);
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

    protected function write($data)
    {
        service('models')->get($this->model)->insert($data);
    }

}