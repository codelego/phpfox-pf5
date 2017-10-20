<?php

namespace Phpfox\Paging;


abstract class AbstractDecorator implements DecoratorInterface
{
    /**
     * @var array
     */
    protected $context = [];

    /**
     * AbstractDecorator constructor.
     *
     * @param array $context
     */
    public function __construct(array $context)
    {
        $this->context = $context;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->context[$key]) ? $this->context[$key] : $default;
    }
}