<?php
namespace Phpfox\Router;

class Parameters
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->params;
    }

    /**
     * This method clear old params and set by new params.
     *
     * @param array $data
     *
     * @return $this
     */
    public function add($data)
    {
        foreach ($data as $k => $v) {
            $this->params[$k] = $v;
        }
        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * Reset old data
     */
    public function reset()
    {
        $this->params = [];
    }

    public function isValid()
    {
        return !empty($this->params['action'])
            and !empty($this->params['controller']);
    }
}