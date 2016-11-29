<?php

namespace Phpfox\Mysqli;

use Phpfox\Db\AdapterInterface;
use Phpfox\Db\ConnectException;
use Phpfox\Db\SqlAdapterTrait;
use Phpfox\Db\SqlException;

/**
 * Class MysqliAdapter
 *
 * @package Phpfox\Db
 */
class MysqliAdapter implements AdapterInterface
{
    use SqlAdapterTrait;

    /**
     * @var \mysqli|null
     */
    protected $master;

    /**
     * @var \mysqli|null
     */
    protected $slave;

    /**
     * @var \mysqli|null
     */
    protected $lastUsage;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var bool
     */
    protected $_inTransaction = false;

    /**
     * MysqliAdapter constructor.
     *
     * @param $params
     *
     */
    public function __construct($params)
    {
        $this->params = array_merge([
            'host'     => 'localhost',
            'port'     => 3306,
            'database' => null,
            'user'     => null,
            'password' => null,
            'socket'   => null,
            'charset'  => 'utf8mb4',
            'masters'  => [],
            'slaves'   => [],
        ], $params);

        if (empty($this->params['masters'])) {
            $this->params['masters'] = [$this->params['host']];
        }
    }

    /**
     * @return bool
     */
    public function inTransaction()
    {
        return $this->_inTransaction;
    }

    public function reconnect()
    {
        $this->disconnect();
        $this->connect();
    }

    public function disconnect()
    {
        if ($this->master instanceof \mysqli) {
            $this->master->close();
            $this->master = null;
        }

        if ($this->slave instanceof \mysqli) {
            $this->slave->close();
            $this->slave = null;
        }

        $this->master = null;
        $this->slave = null;
        $this->lastUsage = null;
        $this->_inTransaction = null;
    }

    public function connect()
    {
        $this->getMaster();
        $this->getSlave();
    }

    /**
     * @return \mysqli
     */
    public function getMaster()
    {
        if (!$this->master) {
            $this->master = $this->_connect(true);
        }
        return $this->master;
    }

    public function _connect($flag)
    {
        $params = $this->params;
        $mysqli = new \mysqli();
        $mysqli->init();

        $hosts = $params['masters'];
        $port = (int)$params['port'];
        $socket = $params['socket'];
        if (!$port) {
            $port = 3306;
        }


        if (!$flag) {
            $hosts = $params['slaves'];
        }

        if (!$flag and empty($hosts)) {
            return $this->getMaster();
        }

        if (empty($hosts)) {
            throw new ConnectException('There are no host available');
        }

        $hosts = array_values($hosts);
        $offset = mt_rand(0, count($hosts) - 1);
        $host = $hosts[$offset];

        $result = $mysqli->real_connect($host, $params['user'],
            $params['password'], $params['database'], $port);

        if (!$result) {
            throw new ConnectException('Could not connect database '
                . $mysqli->error);
        }

        $mysqli->set_charset($params['charset']);

        return $mysqli;
    }

    /**
     * @return \mysqli
     */
    public function getSlave()
    {
        if (!$this->slave) {
            $this->slave = $this->_connect(false);
        }
        return $this->slave;
    }

    public function quoteIdentifier($value)
    {
        return '`' . $value . '`';
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function quoteValue($value)
    {
        switch (true) {
            case is_bool($value):
                return $value ? 1 : 0;
            case is_null($value):
                return 'NULL';
            case is_array($value):
                return implode(', ', array_map([$this, 'quoteValue'], $value));
            case is_string($value):
                return '\'' . $this->escape($value) . '\'';
            case is_numeric($value):
                return $value;
            default:
                return $value;
        }
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function escape($string)
    {
        return $this->getMaster()->real_escape_string($string);
    }

    /**
     * @return int
     */
    public function lastId()
    {
        return $this->getMaster()->insert_id;
    }

    /**
     * @return array [string, ]
     */
    public function tables()
    {
        $result = $this->getMaster()->query('show tables');

        $response = [];

        while (null != ($row = mysqli_fetch_array($result))) {
            $response[] = $row[0];
        }

        return $response;
    }

    public function begin()
    {
        if ($this->_inTransaction) {
            return $this;
        }

        $this->execute('START TRANSACTION', true);

        $this->_inTransaction = true;
        return $this;
    }

    public function execute($sql, $master = true)
    {
        $this->lastUsage = $master ? $this->getMaster() : $this->getSlave();

        $result = $this->lastUsage->query($sql);

        if (false === $result || null === $result) {
            throw new SqlException($this->error() . PHP_EOL . $sql);
        }

        return new MysqliSqlResult($result);
    }

    public function error($master = true)
    {
        if ($this->lastUsage instanceof \mysqli) {
            return $this->lastUsage->error;
        }
        return '';
    }

    public function commit()
    {
        if (!$this->_inTransaction) {
            return false;
        }

        $this->execute('COMMIT', true);
        $this->_inTransaction = false;

        return $this;
    }

    public function rollback()
    {
        $this->execute('ROLLBACK', true);
        $this->_inTransaction = false;

        return $this;
    }
}