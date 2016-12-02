<?php

namespace Phpfox\Mvc;

class MvcResponse
{
    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $format = 'json';

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $url  External/Internal url
     * @param int    $code Optional, default 302, 301:  Permanently, 302:
     *                     Temporary
     *
     * @return bool
     */
    public function redirect($url, $code = 302)
    {
        $this->code = $code;
        if (!headers_sent()) {
            http_response_code($code);
            header('location: ' . $url);
        }
        $this->terminate();

        return false;
    }

    public function terminate()
    {
        \Phpfox::emit('onResponderTerminate', null);

        if (PHPFOX_UNIT_TEST == false and function_exists('ob_get_level')) {
            while (ob_get_level()) {
                ob_get_clean();
            }
        }

        echo \Phpfox::get('view.layout')->prepare()->render();

    }

    public function getCode()
    {
        return $this->code;
    }

    /**
     * @link https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     *
     * @param int $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        if (!headers_sent()) {
            http_response_code((int)$code);
        }
        return $this;
    }
}