<?php

namespace Phpfox\Mysqli;

use Phpfox\Db\SqlResultInterface;

/**
 * Class MysqliSqlResult
 *
 * @package Phpfox\Mysqli
 */
class MysqliSqlResult implements SqlResultInterface
{

    /**
     * @var \mysqli_result
     */
    private $resource;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function isValid()
    {
        return $this->resource !== false;
    }


    public function fetch()
    {
        $result = [];

        while (null != ($object = $this->resource->fetch_assoc())) {
            $result[] = $object;
        }

        return $result;
    }
}