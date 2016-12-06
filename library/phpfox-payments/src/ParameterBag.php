<?php

namespace Phpfox\Payments;


class ParameterBag
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * ParameterBag constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function get($key)
    {
        return @$this->data[$key];
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function all()
    {
        return $this->data;
    }
}