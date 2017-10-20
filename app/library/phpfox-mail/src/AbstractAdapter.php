<?php

namespace Phpfox\Mailer;

abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * SmtpMailAdapter constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    public function addError($msg)
    {
        $this->errors[] = $msg;
    }

    public function getErrors()
    {
        return implode(PHP_EOL, $this->errors);
    }

    public function clearErrors()
    {
        $this->errors = [];
    }

    public function setDebug($isDebug)
    {
        $this->params['debug'] = (boolean)$isDebug;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        if ($this->get('debug') == null) {
            return PHPFOX_ENV == 'development';
        }

        return !!$this->get('debug');
    }
}