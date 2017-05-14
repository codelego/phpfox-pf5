<?php

namespace Phpfox\Db;


use Phpfox\Model\GatewayException;
use Phpfox\Model\GatewayInterface;
use Phpfox\Model\ModelInterface;

class DbTableGateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected $_identity;

    /**
     * @var array
     */
    protected $_columns;

    /**
     * @var array
     */
    protected $_primary;

    /**
     * The column to use when query findById, deleteById, ....
     *
     * @var string
     */
    protected $_query_id;

    /**
     * @var string
     */
    protected $_table;

    /**
     * @var string
     */
    protected $_prototype;

    /**
     * @var string
     */
    protected $_adapter;

    /**
     * @var string
     */
    protected $_model_id;

    /**
     * DbTableGateway constructor.
     *
     * @param string $id
     * @param string $table
     * @param string $prototype
     * @param string $adapter
     * @param string $meta
     */
    public function __construct(
        $id,
        $table,
        $prototype,
        $adapter = null,
        $meta = null
    ) {

        $this->_model_id = $id;

        if (substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        $this->_table = $table;
        $this->_prototype = $prototype;
        $this->_adapter = $adapter ? $adapter : PHPFOX_DEFAULT_DB;

        if ($meta) {
            list($this->_identity, $this->_primary, $this->_query_id,
                $this->_columns)
                = include PHPFOX_DIR . $meta;
        }

    }

    public function insert($values)
    {
        $temp = array_intersect_key(
            $values instanceof ModelInterface ? $values->toArray() : $values,
            $this->_columns);

        $result = (new SqlInsert($this->adapter()))
            ->insert($this->_table)
            ->values($temp)
            ->execute();

        if ($this->_identity and $values instanceof ModelInterface and $result
            && !$values->__get($this->_identity)
        ) {
            $values->__set($this->_identity, $result->lastId());
        }

        return $result;
    }

    /**
     * @return DbAdapterInterface
     */
    public function adapter()
    {
        return _get($this->_adapter);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }

    public function updateBy($values)
    {
        // update changed values, not all ?
        $temp = array_intersect_key($values instanceof ModelInterface
            ? $values->getChanged() : $values,
            array_diff_key($this->_columns, $this->_primary));

        if (empty($temp)) {
            return false;
        }

        $wheres = [];
        foreach (
            array_intersect_key($values instanceof ModelInterface
                ? $values->toArray() : $values, $this->_primary) as $k => $v
        ) {
            $wheres[$k . '=?'] = $v;
        }

        return (new SqlUpdate($this->adapter()))
            ->update($this->_table)
            ->values($temp)
            ->where($wheres)
            ->execute();
    }

    public function update()
    {
        return (new SqlUpdate($this->adapter()))
            ->update($this->_table);
    }

    /**
     * @param  array|null $values
     *
     * @return ModelInterface|mixed
     */
    public function create($values = null)
    {
        return new $this->_prototype($values, false);
    }

    public function deleteBy($values)
    {
        $wheres = [];
        foreach (
            array_intersect_key($values instanceof ModelInterface
                ? $values->toArray() : $values, $this->_primary) as $k => $v
        ) {
            $wheres[$k . '=?'] = $v;
        }

        return (new SqlDelete($this->adapter()))->from($this->_table)
            ->where($wheres)
            ->execute();
    }

    public function findById($id)
    {
        if ($this->_query_id) {
            return $this->select()->where($this->_query_id . '=?', (string)$id)
                ->first();
        }
        throw new GatewayException("Can not use findById");
    }

    /**
     *
     * @param string $columns
     *
     * @return SqlSelect
     */
    public function select($columns = '*')
    {
        return (new SqlSelect($this->adapter()))
            ->select($columns)
            ->setPrototype($this->_prototype)
            ->from($this->_table);
    }

    public function deleteById($id)
    {
        return (new SqlDelete($this->adapter()))->from($this->_table)
            ->where($this->_query_id . '=?', (string)$id)
            ->execute();
    }

    /**
     * @return SqlDelete
     */
    public function delete()
    {
        return (new SqlDelete($this->adapter()))->from($this->_table);
    }
}