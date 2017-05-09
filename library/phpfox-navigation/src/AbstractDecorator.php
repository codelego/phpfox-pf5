<?php

namespace Phpfox\Navigation;


abstract class AbstractDecorator implements DecoratorInterface
{
    /**
     * @var int
     */
    protected $level = 4;

    /**
     * @var array
     */
    protected $context = [];

    /**
     * @var array
     */
    protected $defaults
        = [
            'level0'       => 'aside',
            'level1'       => '',
            'level2'       => '',
            'level3'       => '',
            'level4'       => '',
            'max'          => 12,
            'dropdownIcon' => '&nbsp;<i class="fa fa-tail"></i>',
            'moreLabel'    => 'More',
        ];

    /**
     * AbstractDecorator constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->context = array_merge($this->defaults, $params);
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