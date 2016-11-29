<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Phpfox\Mvc;

/**
 * Interface ConfigInterface
 *
 * @package Phpfox\Config
 */
interface ConfigManagerInterface
{
    /**
     * Extend configure using merge recursive
     *
     * @param array $data
     *
     * @return $this
     */
    public function extend($data);

    /**
     * @param string $key
     * @param null   $item
     *
     * @return mixed
     */
    public function get($key, $item = null);

    /**
     * @param string $key
     * @param array  $data
     *
     * @return $this
     */
    public function set($key, $data);
}