<?php

namespace Phpfox\Db;

/**
 * Class SqlCondition
 *
 * @package Phpfox\Db
 */
class SqlCondition
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $elements = [];

    /**
     * SqlCondition constructor.
     *
     * @param $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param      $expression
     * @param null $value
     *
     * @return $this
     */
    public function where($expression, $value = null)
    {
        $this->_where(' AND ', $expression, $value);
        return $this;
    }


    /**
     * @param      $type
     * @param      $statement
     * @param null $value
     *
     * @return $this
     */
    protected function _where($type, $statement, $value = null)
    {
        if (is_array($statement)) {
            foreach ($statement as $k => $v) {
                $this->_where($type, $k, $v);
            }
        } elseif (is_null($value)) {
            $this->elements [] = [
                $type,
                str_replace('?', 'NULL', $statement),
            ];
        } elseif (is_array($value)) {
            $this->elements [] = [
                $type,
                strtr($statement, $this->quoteArray($value)),
            ];
        } elseif ($value instanceof SqlLiteral) {
            $this->elements [] = [$type, $value->getLiteral()];
        } else {
            $this->elements [] = [
                $type,
                str_replace('?', $this->adapter->quoteValue($value),
                    $statement),
            ];
        }
        return $this;
    }

    /**
     * @param array $values
     *
     * @return array
     */
    protected function quoteArray(array $values)
    {
        $result = [];

        // check first key

        if (is_numeric(array_keys($values)[0])) {
            foreach ($values as $k => $v) {
                $result[$k] = $this->adapter->quoteValue($v);
            }

            return ['?' => '(' . implode(', ', $result) . ')'];
        } else {
            foreach ($values as $k => $v) {
                $result[$k] = $this->adapter->quoteValue($v);
            }
        }

        return $result;

    }

    /**
     * @param $expression
     * @param $value
     *
     * @return SqlCondition
     */
    public function orWhere($expression, $value)
    {
        return $this->_where(' OR ', $expression, $value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepare();
    }

    /**
     * @return string
     */
    public function prepare()
    {

        $result = '';

        foreach ($this->elements as $item) {
            list($type, $express) = $item;

            if ($result == '') {
                $result = ' (' . $express . ') ';
            } else {
                $result .= $type . ' (' . $express . ') ';
            }
        }

        if ('' == $result) {
            $result = ' 1 ';
        }

        return $result;
    }
}