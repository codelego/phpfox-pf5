<?php

namespace Phpfox\Db;

/**
 * Interface AdapterInterface
 *
 * @package Phpfox\Db
 */
interface AdapterInterface
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
     * @return SqlSelect
     */
    public function sqlSelect();

    /**
     * @param $table
     * @param $data
     *
     * @return SqlInsert
     */
    public function sqlInsert($table, $data);

    /**
     * @param $table
     * @param $data
     *
     * @return SqlUpdate
     */
    public function sqlUpdate($table, $data);

    /**
     * @param string $table
     *
     * @return SqlDelete
     */
    public function sqlDelete($table);

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