<?php

namespace Phpfox\Action;

class Response
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
    protected $prototype = 'mvc.response.html';

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
     *
     * @codeCoverageIgnore
     *
     */
    public function redirect($url, $code = 302)
    {
        $this->code = intval($code);

        if (!headers_sent()) {
            http_response_code($code);
            header('location: ' . $url);
        }

        if (!PHPFOX_UNIT_TEST) {
            $this->terminate();
        }

        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function terminate()
    {
        \Phpfox::get($this->prototype)
            ->run($this);
    }

    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getPrototype()
    {
        return $this->prototype;
    }

    /**
     * @param string $prototype
     */
    public function setPrototype($prototype)
    {
        $this->prototype = $prototype;
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
        $this->code = intval($code);

        //@codeCoverageIgnoreStart
        if (!headers_sent()) {
            http_response_code($this->code);
        }
        //@codeCoverageIgnoreEnd
        return $this;
    }
}