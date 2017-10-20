<?php

namespace Phpfox\Kernel;

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
    protected $prototype = 'response.html';

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

        /** @var ResponsePrototypeInterface $obj */
        $obj = \Phpfox::get($this->prototype);
        $obj->redirect($url, $code);

        return false;
    }

    /**
     * @return string
     */
    public function terminate()
    {
        /** @var ResponsePrototypeInterface $obj */
        $obj = \Phpfox::get($this->prototype);
        echo $obj->run($this);
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