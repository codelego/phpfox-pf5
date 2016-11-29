<?php

namespace Phpfox\Mvc;

class Responder
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
     * @return mixed|ViewModel
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


    public function response()
    {
        $layout = service('layout')->prepare();
        return service('renderer')->render($layout);
    }

    /**
     * @param string $url  External/Internal url
     * @param int    $code Optional, default 302, 301:  Permanently, 302:
     *                     Temporary
     */
    public function redirect($url, $code = 302)
    {
        $this->code = $code;
        if (!headers_sent()) {
            http_response_code($code);
            header('location: ' . $url);
        }
        $this->terminate();
    }

    public function terminate()
    {
        events()->trigger('onResponderTerminate');
        exit();
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