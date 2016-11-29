<?php
namespace Phpfox\Db;

/**
 * Class SqlLiteral
 *
 * @package Phpfox\Db
 */
class SqlLiteral
{
    /**
     * @var string
     */
    private $literal;

    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->literal = (string)$string;
    }

    /**
     * @return string
     */
    public function getLiteral()
    {
        return $this->literal;
    }

    /**
     * @param string $literal
     */
    public function setLiteral($literal)
    {
        $this->literal = $literal;
    }

    public function __toString()
    {
        return $this->literal;
    }

}