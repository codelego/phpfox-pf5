<?php

namespace Phpfox\Db;

/**
 * Class SqlInsert
 *
 * @package Phpfox\Db
 */
class SqlInsert
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;
    /**
     * @var string
     */
    protected $table = null;
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var bool
     */
    protected $_ignoreOnDuplicate = false;
    /**
     * @var bool
     */
    protected $_delay = false;

    /**
     * SqlInsert constructor.
     *
     * @param $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $table
     * @param null   $data
     *
     * @return $this
     */
    public function insert($table, $data = null)
    {
        if (is_string($table) && substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        $this->table = (string)$table;

        if (!empty($data)) {
            $this->data = $data;
        }

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function values($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param $flag
     *
     * @return $this
     */
    public function ignoreOnDuplicate($flag)
    {
        $this->_ignoreOnDuplicate = (bool)$flag;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDelay()
    {
        return $this->_delay;
    }

    /**
     * @param $delay
     *
     * @return $this
     */
    public function setDelay($delay)
    {
        $this->_delay = $delay;

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

        $result = $this->adapter->execute($sql, true);

        if (false === $result) {
            throw new SqlException($this->adapter->error(true) . PHP_EOL
                . $sql);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prepare()
    {

        $keys = [];
        $values = [];
        foreach ($this->data as $key => $value) {
            $keys [] = $key;
            $values[] = $this->adapter->quoteValue($value);
        }

        $delay = $this->_delay ? ' DELAY ' : '';
        $ignore = $this->_ignoreOnDuplicate ? ' IGNORE ' : '';

        return 'INSERT ' . $delay . $ignore . ' INTO ' . $this->table . '('
        . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')';
    }
}