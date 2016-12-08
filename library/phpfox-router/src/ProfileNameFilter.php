<?php

namespace Phpfox\Router;


class ProfileNameFilter implements FilterInterface
{
    /**
     * Cached value for last usage
     *
     * @var string[bool]
     */
    protected $cached = [];

    /**
     * @param string $key
     * @param bool   $value
     *
     * @return $this
     */
    public function cache($key, $value)
    {
        $this->cached[$key] = (bool)$value;
        return $this;
    }

    public function filter($parameters)
    {
        $name = $parameters['name'];

        if (!$name) {
            return false;
        }

        if (isset($this->cached[$name])) {
            return $this->cached[$name];
        }

        $response = \Phpfox::emit('onFilterProfileName', $parameters);

        if (!$response) {
            return $this->cached[$name] = false;
        }

        if (!$response->last()) {
            return $this->cached[$name] = false;
        }

        return $this->cached[$name] = true;
    }
}