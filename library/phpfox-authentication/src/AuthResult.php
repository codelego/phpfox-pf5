<?php
namespace Phpfox\Authentication;


/**
 * Describe authenticate result
 *
 * Constants:
 *
 * - SUCCESS
 * - MISSING_IDENTITY
 * - INVALID_IDENTITY
 * - MISSING_CREDENTIAL
 * - INVALID_CREDENTIAL
 * - UN_CATEGORIZE
 *
 * @package Phpfox\Authentication
 */
class AuthResult
{

    const SUCCESS = 0;

    const INVALID_IDENTITY = 1;

    const INVALID_CREDENTIAL = 2;

    const UN_CATEGORIZE = 4;

    /**
     * @var int
     */
    private $code = 5;

    /**
     * @var int
     */
    private $identity = 0;

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param int $identity
     *
     * @return $this
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    public function isSuccess()
    {
        return $this->code == self::SUCCESS;
    }
}