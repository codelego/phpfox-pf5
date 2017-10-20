<?php

namespace Phpfox\Kernel;

class CurlRequest
{
    /**
     * @var \resource
     */
    private $stream;

    /**
     * @var array
     */
    private $params = [];

    /**
     * CurlRequest constructor.
     *
     * @param array $options
     */
    function __construct($options = [])
    {
        $this->stream = curl_init();

        // default options
        curl_setopt_array($this->stream, [
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
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $value
     */
    public function setUrl($value)
    {
        $this->set('url', $value);
        curl_setopt($this->stream, CURLOPT_URL, $value);

    }

    /**
     * @param $value
     */
    public function setTimeout($value)
    {
        $this->set('timeout', $value);
        curl_setopt($this->stream, CURLOPT_TIMEOUT, intval($value));
    }


    public function doGet()
    {
        $content = curl_exec($this->stream);

        $message = curl_error($this->stream);

        $error = curl_errno($this->stream);

        if ($error) {
            throw new \Exception("Curl request error: " . $message);
        }

        return new CurlResponse($content, $error, $message);
    }

    /**
     *
     */
    public function doPost()
    {
        // TODO: Implement post() method.
    }

    /**
     * @param $destination
     *
     * @return bool
     * @throws \Exception
     */
    public function doDownload($destination)
    {
        if (file_exists($destination) and !@unlink($destination)) {
            throw new \Exception("Oops! file $destination exists but is un-writable");
        }

        if (!_ensure_directory(dirname($destination), 0777)) {
            throw new \Exception("Oops! Could not make `$destination`");
        }

        $content = curl_exec($this->stream);

        $error = curl_error($this->stream);

        $message = curl_errno($this->stream);

        if ($error) {
            throw new \Exception("Oops! curl error " . $message);
        }

        $result = @file_put_contents($destination, $content);

        if (!$result) {
            throw new \Exception("Oops! Could not write content to $destination");
        }

        unset($content);

        return true;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->set('headers', $headers);

        curl_setopt($this->stream, CURLOPT_HEADER, $headers);
    }

    /**
     * @return resource
     */
    public function getStream()
    {
        return $this->stream;
    }

    public function getJSON()
    {
        return $this->doGet()->asJSON();
    }

    public function getString()
    {
        return $this->doGet()->asString();
    }
}