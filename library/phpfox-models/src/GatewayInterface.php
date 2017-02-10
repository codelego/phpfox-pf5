<?php

namespace Phpfox\Model;

use Phpfox\Db\SqlDelete;
use Phpfox\Db\SqlUpdate;

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
     * @param mixed $values
     *
     * @return bool
     */
    public function updateBy($values);

    /**
     * @param mixed $values
     *
     * @return bool
     */
    public function deleteBy($values);

    /**
     * @return SqlDelete
     */
    public function delete();

    /**
     * @return SqlUpdate
     */
    public function update();
}