<?php

namespace Phpfox\Widget;

/**
 * Interface WidgetInterface
 *
 * @package Phpfox\Widget
 */
interface WidgetInterface
{
    /**
     * WidgetInterface constructor.
     *
     * @param array $params
     */
    public function __construct($params = []);

    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function getParam($key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam($key, $value);

    /**
     * @return array
     */
    public function getParams();

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams($params = []);

    /**
     * @return mixed
     */
    public function resolve();
}