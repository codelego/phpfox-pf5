<?php

namespace Phpfox\Model;

/**
 * Class GatewayInterface
 *
 * @package Phpfox\Model
 */
interface GatewayInterface
{
    /**
     * @param mixed $id
     *
     * @return mixed
     * @throws GatewayException
     */
    public function findById($id);

    /**
     * @param  mixed $id
     *
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param array|ModelInterface $values
     *
     * @return mixed
     */
    public function insert($values);

    /**
     * @param  array|ModelInterface $values
     *
     * @return bool
     */
    public function update($values);

    /**
     * @param  array|ModelInterface $values
     *
     * @return bool
     */
    public function delete($values);
}