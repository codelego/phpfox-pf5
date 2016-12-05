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
     * @return array
     */
    public function first();

    /**
     * @return bool
     */
    public function isValid();
}