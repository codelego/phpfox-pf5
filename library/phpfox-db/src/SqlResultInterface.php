<?php

namespace Phpfox\Db;

/**
 * Interface QueryResult
 *
 * @package Phpfox\Db
 */
interface SqlResultInterface
{
    public function fetch();

    /**
     * @return bool
     */
    public function isValid();
}