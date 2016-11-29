<?php


namespace Phpfox\Db;

/**
 * Class SqlUpdate
 *
 * @package Phpfox\Db
 */
class SqlUpdate
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
     * @var array
     */
    protected $data = [];

    /**
     * @var SqlCondition
     */
    protected $sqlCondition = null;

    /**
     * SqlUpdate constructor.
     *
     * @param mixed $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $table
     *
     * @return $this
     */
    public function update($table)
    {
        if (is_string($table) && substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        $this->table = $table;
        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function values($data)
    {
        $this->data = $data;
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
            throw new DbException($sql . $this->adapter->error());
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {

        $array = [];

        foreach ($this->data as $key => $value) {
            $array [] = $key . '=' . $this->adapter->quoteValue($value);
        }

        $where = empty($this->sqlCondition) ? ''
            : ' WHERE ' . $this->sqlCondition->prepare();

        return 'UPDATE ' . $this->table . ' SET ' . implode(', ', $array)
        . $where;
    }
}