<?php

namespace Phpfox\Db;

/**
 * Interface QueryResult
 *
 * @package Phpfox\Db
 */
interface SqlResultInterface
{
    /**
     *Fetch all first record as association array
     *
     * @return array
     */
    public function all();

    /**
     * @param $prototype
     *
     * @return $this
     */
    public function setPrototype($prototype);

    /**
     * Fetch the first record as association array
     *
     * @return array|mixed
     */
    public function first();

    /**
     * @return bool
     */
    public function isValid();

    /**
     * @return string|null
     */
    public function error();

    /**
     * @return int|null
     */
    public function lastId();
}