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

    /**
     * @var string
     */
    private $prototype;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function setPrototype($prototype)
    {
        $this->prototype = $prototype;
        return $this;
    }

    public function isValid()
    {
        return $this->resource !== false;
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