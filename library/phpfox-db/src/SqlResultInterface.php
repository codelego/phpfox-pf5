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
     * Fetch the first record as association array
     *
     * @return array
     */
    public function one();

    /**
     * @return bool
     */
    public function isValid();
}