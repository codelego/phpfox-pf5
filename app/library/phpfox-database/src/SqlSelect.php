<?php

namespace Phpfox\Db;


/**
 * Class SqlSelect
 *
 * @package Phpfox\Db
 */
class SqlSelect
{
    /**
     *
     */
    const COUNT_NAME = '_COUNT_TOTAL_';
    /**
     *
     */
    const LEFT_JOIN = 'LEFT JOIN';
    /**
     *
     */
    const JOIN = 'JOIN';
    /**
     *
     */
    const RIGHT_JOIN = 'RIGHT JOIN';
    /**
     * @var DbAdapterInterface
     */
    private $adapter;

    /**
     * @var array
     */
    private $_columns = [];

    /**
     * @var array
     */
    private $_tables = [];

    /**
     * @var SqlCondition
     */
    private $_where;

    /**
     * @var SqlCondition
     */
    private $_having;

    /**
     * @var SqlJoin
     */
    private $_join;

    /**
     * @var string
     */
    private $_group;

    /**
     * @var int
     */
    private $_limit = 0;

    /**
     * @var int
     */
    private $_offset = 0;

    /**
     * @var string
     */
    private $_order = '';

    /**
     * @var bool
     */
    private $_useMaster = false;

    /**
     * @var bool
     */
    private $_forUpdate = false;

    /**
     * @var
     */
    private $_prototype;

    /**
     * @ignore
     *
     * @param mixed $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return $this
     */
    public function forUpdate()
    {
        $this->_forUpdate = true;

        return $this;
    }

    /**
     * @param bool $flag
     *
     * @return SqlSelect
     */
    public function useMaster($flag = true)
    {
        $this->_useMaster = (bool)$flag;

        return $this;
    }

    /**
     * @param string $table
     * @param null   $alias
     * @param null   $columns
     *
     * @return $this
     */
    public function from($table, $alias = null, $columns = null)
    {
        if (is_string($table) && substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        if (is_null($alias)) {
            $this->_tables[] = $table;
        } else {
            $this->_tables[] = $table . ' AS ' . (string)$alias;
        }

        if (!is_null($columns)) {
            $this->select($columns);
        }

        return $this;
    }

    /**
     * @param array|string $columns
     *
     * @return $this
     */
    public function select($columns)
    {
        $this->_columns = [];

        if (is_string($columns)) {
            $this->_columns [] = $columns;
        } else {
            if (is_array($columns)) {
                foreach ($columns as $col) {
                    $this->_columns[] = $col;
                }
            }
        }

        return $this;
    }

    /**
     * @param array|string $columns
     *
     * @return $this
     */
    public function andSelect($columns)
    {
        if (is_string($columns)) {
            $this->_columns [] = $columns;
        } else {
            if (is_array($columns)) {
                foreach ($columns as $col) {
                    $this->_columns[] = $col;
                }
            }
        }

        return $this;
    }

    /**
     * @param string|array $wheres
     * @param              $data
     *
     * @return SqlSelect
     */
    public function where($wheres, $data = null)
    {
        if (null == $this->_where) {
            $this->_where = new SqlCondition($this->adapter);
        }

        $this->_where->where($wheres, $data);

        return $this;
    }

    /**
     * @param bool               $if
     * @param string|array       $expression
     * @param string|array|mixed $data
     *
     * @return $this
     */
    public function whereIf($if, $expression, $data)
    {
        if (!$if) {
            return $this;
        }

        if (null == $this->_where) {
            $this->_where = new SqlCondition($this->adapter);
        }

        $this->_where->where($expression, $data);

        return $this;
    }

    /**
     * @param $expression
     * @param $data
     *
     * @return $this
     */
    public function orWhere($expression, $data = null)
    {
        if (null == $this->_where) {
            $this->_where = new SqlCondition($this->adapter);
        }

        $this->_where->orWhere($expression, $data);

        return $this;
    }

    /**
     * @param $expression
     * @param $data
     *
     * @return $this
     */
    public function having($expression, $data)
    {
        if (null == $this->_having) {
            $this->_having = new SqlCondition($this->adapter);
        }
        $this->_having->where($expression, $data);

        return $this;
    }

    /**
     * @param $expression
     * @param $data
     *
     * @return $this
     */
    public function orHaving($expression, $data)
    {
        if (null == $this->_having) {
            $this->_having = new SqlCondition($this->adapter);
        }
        $this->_having->orWhere($expression, $data);

        return $this;
    }


    public function paging($page, $limit)
    {
        return _get('paging')->factory($this)->paging($page, $limit);
    }

    /**
     * @param int $limit
     * @param int $offset optional default "0"
     *
     * @return SqlSelect
     */
    public function limit($limit, $offset = 0)
    {
        $this->_limit = (int)$limit;
        $this->_offset = (int)$offset;

        return $this;
    }

    /**
     * @param $columns
     *
     * @return $this
     */
    public function group($columns)
    {
        $this->_group = $columns;

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function join($table, $alias, $expression, $data = null, $columns = null)
    {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->adapter);
        }

        $this->_join->join(self::JOIN, $table, $alias, $expression, $data);

        if (null != $columns) {
            $this->select($columns);
        }

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function leftJoin(
        $table,
        $alias,
        $expression,
        $data = null,
        $columns = null
    ) {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->adapter);
        }

        $this->_join->join(self::LEFT_JOIN, $table, $alias, $expression, $data);

        if (null != $columns) {
            $this->select($columns);
        }

        return $this;
    }

    /**
     * @param $table
     * @param $alias
     * @param $expression
     * @param $data
     * @param $columns
     *
     * @return $this
     */
    public function rightJoin($table, $alias, $expression, $data, $columns)
    {
        if (null == $this->_join) {
            $this->_join = new SqlJoin($this->adapter);
        }

        $this->_join->join(self::RIGHT_JOIN, $table, $alias, $expression,
            $data);

        if (null != $columns) {
            $this->select($columns);
        }

        return $this;
    }

    /**
     * @param string $column
     * @param string $order
     *
     * @return $this
     */
    public function order($column, $order)
    {
        switch (true) {
            case $order == 'asc':
            case $order == 'ASC':
            case $order === 1:
            case $order === '1':
                $this->_order = $column . ' ASC';
                break;
            case $order == 'DESC':
            case $order == 'desc':
            case $order === -1:
            case $order === "-1":
                $this->_order = $column . ' DESC';
                break;
            case $order == null:
            default:
                $this->_order = $column;

        }

        return $this;
    }

    /**
     * @param null $sql
     *
     * @return int
     */
    public function count($sql = null)
    {
        if (null == $sql) {
            $sql = $this->prepareCount();
        }

        $result = $this->adapter->execute($sql, $this->_useMaster);

        $row = $result->first();

        return (int)$row['_COUNT_TOTAL_'];
    }

    /**
     * @return string
     */
    public function prepareCount()
    {
        $tables = implode(', ', $this->_tables);
        $where = empty($this->_where) ? ''
            : ' WHERE ' . $this->_where->prepare();
        $having = empty($this->_having) ? ''
            : ' HAVING ' . $this->_having->prepare();
        $join = empty($this->_join) ? '' : ' ' . $this->_join->prepare();
        $group = empty($this->_group) ? '' : ' GROUP BY ' . $this->_group;

        return 'SELECT count(*) as ' . self::COUNT_NAME . ' FROM ' . $tables
            . $join . $where . $group . $having . PHP_EOL;
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

        $result = $this->adapter->execute($sql, $this->_useMaster);

        $result->setPrototype($this->_prototype);

        if (!$result->isValid()) {
            if (PHPFOX_ENV == 'development') {
                exit($sql);
            }
            throw new SqlException($sql . PHP_EOL . $result->error());
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {
        $columns = empty($this->_columns) ? '*'
            : implode(', ', $this->_columns);
        $tables = implode(', ', $this->_tables);

        $where = empty($this->_where) ? ''
            : ' WHERE ' . $this->_where->prepare();
        $having = empty($this->_having) ? ''
            : ' HAVING ' . $this->_having->prepare();
        $join = empty($this->_join) ? '' : ' ' . $this->_join->prepare();

        $limit = empty($this->_limit) ? ''
            : ' LIMIT ' . $this->_offset . ', ' . $this->_limit;
        $group = empty($this->_group) ? '' : ' GROUP BY ' . $this->_group;
        $order = empty($this->_order) ? '' : ' ORDER BY ' . $this->_order;
        $forUpdate = $this->_forUpdate ? ' FOR UPDATE' : '';


        return 'SELECT ' . $columns . ' FROM ' . $tables . $join . $where
            . $group . $having . $order . $limit . $forUpdate . PHP_EOL;
    }

    /**
     * @param string $prototype
     *
     * @return $this
     */
    public function setPrototype($prototype)
    {
        $this->_prototype = $prototype;
        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->execute()->all();
    }

    /**
     * @return array|mixed
     */
    public function first()
    {
        return $this->limit(1, 0)->execute()->first();
    }
}