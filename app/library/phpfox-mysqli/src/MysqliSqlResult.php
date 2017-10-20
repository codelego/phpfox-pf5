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
     * @var MysqliDbAdapter
     */
    private $adapter;

    /**
     * @var \mysqli_result
     */
    private $resource;

    /**
     * @var string
     */
    private $prototype;

    public function __construct($adapter, $resource)
    {
        $this->adapter = $adapter;
        $this->resource = $resource;
    }

    public function setPrototype($prototype)
    {
        $this->prototype = $prototype;
        return $this;
    }

    public function isValid()
    {
        return $this->resource != false;
    }

    public function error()
    {
        return $this->adapter->error();
    }

    public function lastId()
    {
        return $this->adapter->lastId();
    }

    public function all()
    {
        $result = [];

        if ($this->prototype) {
            while (null != ($object
                    = $this->resource->fetch_assoc())) {
                $result[] = new $this->prototype($object, true);
            }
        } else {
            while (null != ($object = $this->resource->fetch_assoc())) {
                $result[] = $object;
            }

        }
        return $result;
    }

    public function first()
    {
        if ($this->prototype) {
            if (null != ($data = $this->resource->fetch_assoc())) {
                return new $this->prototype($data, true);
            } else {
                return null;
            }
        }
        return $this->resource->fetch_assoc();
    }
}