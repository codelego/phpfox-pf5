<?php
namespace Phpfox\Action;


class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $host;

    /**
     * @param array $data
     *
     * @return Request
     */
    public static function factory($data)
    {
        $request = new Request();
        foreach ($data as $key => $value) {
            if (method_exists($request, $method = 'set' . ucfirst($key))) {
                $request->{$method}($value);
            } else {
                $request->set($key, $value);
            }
        }
        return $request;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->method == 'POST';
    }

    public function isGet()
    {
        return $this->method == 'GET';
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function put($data)
    {
        $this->data = $data;
    }

    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        if (method_exists($this, $method = 'get' . ucfirst($key))) {
            return $this->{$method}();
        } else {
            return isset($this->data[$key]) ? $this->data[$key] : $default;
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        if (method_exists($this, $method = 'set' . ucfirst($key))) {
            $this->{$method}($value);
        } else {
            $this->data[$key] = $value;
        }
    }


    /**
     * add more params and override if exists.
     *
     * @param array $params
     */
    public function add($params)
    {
        foreach ($params as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            } else {
                $this->data[$k] = $v;
            }
        }
    }

    /**
     * Put current object to singleton
     */
    public function singleton()
    {
        \Phpfox::get('manager')->set('request', $this);
    }
}