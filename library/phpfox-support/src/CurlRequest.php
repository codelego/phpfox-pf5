<?php

namespace Phpfox\Support;


class CurlRequest
{
    /**
     * @var \resource
     */
    private $ch;

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $error;

    /**
     * @var int
     */
    private $error_no;

    private $url;

    /**
     * @var string
     */
    private $method = 'get';

    /**
     * @var array
     */
    private $params = [];

    function __construct($options = [])
    {
        $this->ch = curl_init();

        // default options
        curl_setopt_array($this->ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
        ]);

        if (!empty($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * @param array $options
     */
    public function setOptions($options = [])
    {
        foreach ($options as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            } else {
                $this->params[$k] = $v;
            }
        }
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param $value
     */
    public function setUrl($value)
    {
        $this->url = $value;
        curl_setopt($this->ch, CURLOPT_URL, $value);

    }

    /**
     * @param $value
     */
    public function setTimeout($value)
    {
        curl_setopt($this->ch, CURLOPT_TIMEOUT, intval($value));
    }

    /**
     *
     */
    public function get()
    {
        $content = curl_exec($this->ch);

        $this->error = curl_error($this->ch);

        $this->error_no = curl_errno($this->ch);

        if ($this->error_no) {
            throw new \Exception("Oops! Could not download " . $this->url . ' '
                . $this->error);
        }

        return $this->_result($content);
    }

    /**
     * @param $content
     *
     * @return mixed
     */
    private function _result($content)
    {
        if ($this->format == 'json') {
            return json_decode($content, true);
        }

        return $content;
    }

    /**
     * @param string $value
     */
    public function setMethod($value)
    {
        $this->method = strtolower($value);
    }

    /**
     *
     */
    public function post()
    {
        // TODO: Implement post() method.
    }

    /**
     * @param $destination
     *
     * @return bool
     * @throws \Exception
     */
    public function download($destination)
    {
        if (file_exists($destination) and !@unlink($destination)) {
            throw new \Exception("Oops! file $destination exists but is un-writable");
        }

        $dir = dirname($destination);

        if (!@is_dir($dir)) {
            if (!@mkdir($dir, 0777, true)) {
                throw new \Exception("Oops! Could not make $dir");
            }
            @chmod($dir, 0777);
        }

        $content = curl_exec($this->ch);

        $this->error = curl_error($this->ch);

        $this->error_no = curl_errno($this->ch);

        if ($this->error_no) {
            throw new \Exception("Oops! Could not download " . $this->url . ' '
                . $this->error);
        }

        $result = @file_put_contents($destination, $content);

        if (!$result) {
            throw new \Exception("Oops! Could not write content to $destination");
        }

        unset($content);

        return true;
    }

    /**
     * @param $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}