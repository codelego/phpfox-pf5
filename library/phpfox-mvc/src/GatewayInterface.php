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
 * Class GatewayInterface
 *
 * @package Phpfox\Mvc
 */
interface GatewayInterface
{

    /**
     * GatewayInterface constructor.
     *
     * @param string $collection
     * @param string $modelClass
     * @param string $gatewayId
     * @param string $adapter
     */
    public function __construct(
        $collection,
        $modelClass,
        $gatewayId,
        $adapter
    );

    /**
     * @param mixed $id
     *
     * @return mixed
     * @throws GatewayException
     */
    public function findById($id);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insert($data);
}