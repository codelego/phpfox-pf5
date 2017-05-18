<?php

namespace Phpfox\Support;

class CurlResponse
{
    /**
     * @var string
     */
    private $data;
    /**
     * @var int
     */
    private $error;
    /**
     * @var string
     */
    private $message;

    /**
     * CurlResponse constructor.
     *
     * @param string $data
     * @param int    $error
     * @param string $message
     */
    public function __construct($data, $error = 0, $message = '')
    {
        $this->data = $data;
        $this->error = $error;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function asJSON()
    {
        return json_decode($this->data, true);
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->data;
    }
}