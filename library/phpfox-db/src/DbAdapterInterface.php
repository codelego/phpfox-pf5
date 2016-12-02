<?php

namespace Phpfox\Db;

interface DbAdapterInterface
{
    /**
     * @return \mysqli
     */
    public function getMaster();

    /**
     * @return \mysqli
     */
    public function getSlave();

    /**
     * @throws DbException
     */
    public function connect();

    /**
     * @throws ConnectException
     */
    public function reconnect();

    /**
     * Disconnect database
     */
    public function disconnect();

    /**
     * @param $value
     *
     * @return mixed
     */
    public function quoteValue($value);

    /**
     * @param string $value
     *
     * @return string mixed
     */
    public function quoteIdentifier($value);

    /**
     * @param $string
     *
     * @return string
     */
    public function escape($string);

    /**
     * @param string $sql
     * @param bool   $master
     *
     * @return SqlResultInterface
     * @throws SqlException
     */
    public function execute($sql, $master = true);

    /**
     * @return int
     */
    public function lastId();

    /**
     * @param  string $argv
     *
     * @return SqlSelect
     */
    public function select($argv = '*');

    /**
     * @param string      $table
     * @param array|array $data
     *
     * @return SqlInsert
     */
    public function insert($table, $data);

    /**
     * @param string     $table
     * @param array|null $data
     * @param array|null $where
     *
     * @return SqlUpdate
     */
    public function update($table, $data = null, $where = null);

    /**
     * @param string     $table
     * @param array|null $where
     *
     * @return SqlDelete
     */
    public function delete($table, $where = null);

    /**
     * @param bool|true $master Use master connection
     *
     * @return string
     */
    public function error($master = true);

    /**
     * Start a new transaction
     *
     * @return $this
     */
    public function begin();

    /**
     * commit current transaction
     *
     * @return $this
     */
    public function commit();

    /**
     * roll back current transaction
     *
     * @return $this
     */
    public function rollback();

    /**
     * @return bool
     */
    public function inTransaction();

}