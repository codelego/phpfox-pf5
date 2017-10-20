<?php

namespace Phpfox\View;

Trait HtmlSimpleTrait
{
    protected $staticUrl = '/pf5/static/';
    /**
     * @var int
     */
    protected $increment = 0;

    /**
     * @var array
     */
    protected $keys = [];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Clear all data
     */
    public function clear()
    {
        $this->increment = 0;
        $this->keys = [];
        $this->data = [];
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function remove($key)
    {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
        }
        return $this;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function ensureKey($value)
    {
        $key = md5($value);

        if (isset($this->keys[$value])) {
            return true;
        }
        return $this->keys[$key] = false;
    }

    /**
     * @ignore
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function _append($key, $value)
    {
        $this->data[$this->_normalize($key)] = $value;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function _normalize($name)
    {
        return is_string($name) ? $name : ++$this->increment . '.0';
    }

    /**
     * @ignore
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function _prepend($key, $value)
    {
        $this->data = array_merge([$this->_normalize($key) => $value],
            $this->data);

    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function getUrl($path)
    {
        return $this->staticUrl . $path;
    }
}