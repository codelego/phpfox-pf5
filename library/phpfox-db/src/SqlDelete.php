<?php

namespace Phpfox\Db;

/**
 * Class SqlDelete
 *
 * @package Phpfox\Db
 */
class SqlDelete
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var SqlCondition
     */
    protected $sqlCondition = null;

    /**
     * SqlDelete constructor.
     *
     * @param $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param $table
     *
     * @return $this
     */
    public function from($table)
    {
        if (is_string($table) && substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        $this->table = $table;

        return $this;
    }

    /**
     * @param      $expression
     * @param null $data
     *
     * @return $this
     */
    public function where($expression, $data = null)
    {
        if (null == $this->sqlCondition) {
            $this->sqlCondition = new SqlCondition($this->adapter);
        }

        $this->sqlCondition->where($expression, $data);

        return $this;
    }

    /**
     * @param      $expression
     * @param null $data
     *
     * @return $this
     */
    public function orWhere($expression, $data = null)
    {
        if (null == $this->sqlCondition) {
            $this->sqlCondition = new SqlCondition($this->adapter);
        }

        $this->sqlCondition->orWhere($expression, $data);

        return $this;
    }

    /**
     * @param null $sql
     *
     * @return SqlResultInterface
     * @throws SqlException
     */
    public function execute($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepare();
        }

        $result = $this->adapter->execute($sql);

        if (false === $result) {
            throw new SqlException($this->adapter->error());
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {
        $where = empty($this->sqlCondition) ? ''
            : ' WHERE ' . $this->sqlCondition->prepare();

        return 'delete ' . 'from' . $this->table . $where;
    }
}