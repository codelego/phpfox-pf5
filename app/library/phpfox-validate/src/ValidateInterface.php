<?php

namespace Phpfox\Validate;


interface ValidateInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isValid($value);

    /**
     * ValidateInterface constructor.
     *
     * @param array $params
     */
    public function __construct($params = []);

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key);
}