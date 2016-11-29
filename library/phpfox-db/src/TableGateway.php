<?php

namespace Phpfox\Db;


use Phpfox\Mvc\GatewayException;
use Phpfox\Mvc\GatewayInterface;

class TableGateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected $_identity = '';

    /**
     * @var array
     */
    protected $_columns = [];

    /**
     * @var array
     */
    protected $_primary = [];

    /**
     * @var string
     */
    protected $_table;

    /**
     * @var string
     */
    protected $_modelClass;

    /**
     * @var array
     */
    protected $_defaults = [];

    protected $_adapter;

    protected $_gatewayId;

    public function __construct(
        $collection,
        $modelClass,
        $gatewayId,
        $adapter
    ) {
        if (substr($collection, 0, 1) == ':') {
            $collection = PHPFOX_TABLE_PREFIX . substr($collection, 1);
        }

        if (null == $adapter) {
            $adapter = 'db';
        }

        $this->_table = $collection;
        $this->_modelClass = $modelClass;
        $this->_adapter = $adapter;
        $this->_gatewayId = $gatewayId;
    }

    /**
     * @return string|false
     */
    public function getIdentity()
    {
        return $this->_identity;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insert($data)
    {

        return (new SqlInsert($this->adapter()))->insert($this->getTable(),
            array_intersect_key($data, $this->getColumns()))->execute();
    }

    /**
     * @return AdapterInterface
     */
    public function adapter()
    {
        return service($this->_adapter);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->_columns;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insertIgnore($data)
    {
        $sql = (new SqlInsert($this->adapter()))->insert($this->getTable(),
            array_intersect_key($data, $this->getColumns()))
            ->ignoreOnDuplicate(true);

        return $sql->execute();
    }

    /**
     * @return array
     */
    public function getDefault()
    {
        return $this->_defaults;
    }

    /**
     * @param  array $data
     *
     * @return array (expression, condition)
     */
    public function getCondition($data)
    {

        $primaryData = array_intersect_key($data, $this->getPrimary());

        $expressionArray = [];
        $condition = [];

        foreach ($primaryData as $k => $v) {
            $expressionArray [] = "$k=:$k ";
            $condition [":$k"] = $v;
        }

        $expression = implode(' AND ', $expressionArray);

        return [$expression, $condition];
    }

    /**
     * @return array
     */
    public function getPrimary()
    {
        return $this->_primary;
    }

    /**
     * @param array $data
     * @param array $values
     *
     * @return mixed
     */
    public function updateModel($data, $values = null)
    {
        if (empty($values)) {
            $values = $data;
        }

        $values = array_intersect_key($values, $this->getColumnNotPrimary());

        if (empty($values)) {
            return true;
        }

        $query = new SqlUpdate($this->adapter());

        $query->update($this->getTable())->values($values);

        foreach ($this->getPrimary() as $column => $type) {
            $query->where("$column=?", $data[$column]);
        }

        return $query->execute();
    }

    /**
     * @return array
     */
    public function getColumnNotPrimary()
    {
        return array_diff_key($this->_columns, $this->_primary);
    }

    /**
     * @param array $values
     *
     * @return SqlUpdate
     */
    public function update($values)
    {
        return (new SqlUpdate($this->adapter()))->update($this->getTable())
            ->values($values);
    }

    /**
     * @param  array|null $data
     *
     * @return mixed
     */
    public function create($data = null)
    {
        return new $this->_modelClass($data, false);
    }

    /**
     *
     * @return SqlSelect
     */
    public function sqlSelect()
    {
        return (new SqlSelect($this->adapter()))->from($this->getTable());
    }

    /**
     * @param  array $data
     *
     * @return mixed
     */
    public function deleteByModelData($data)
    {
        $sql = $this->sqlDelete();

        foreach ($this->getPrimary() as $column => $type) {
            $sql->where("$column=?", $data[$column]);
        }

        return $sql->execute();
    }

    /**
     * @return SqlDelete
     */
    public function sqlDelete()
    {
        return (new SqlDelete($this->adapter()))->from($this->getTable());
    }

    public function findById($id)
    {
        throw new GatewayException("Can not use findById");
    }
}