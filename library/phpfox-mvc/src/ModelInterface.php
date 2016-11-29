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
 * Interface ModelInterface
 *
 * @package Phpfox\Mvc
 */
interface ModelInterface
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * Update data from array
     *
     * @param $array
     *
     * @return $this
     */
    public function exchangeArray($array);

    /**
     * @return bool
     * @throws GatewayException
     */
    public function delete();

    /**
     * @return $this
     * @throws GatewayException
     */
    public function save();

    /**
     * @return bool
     */
    public function isSaved();
}