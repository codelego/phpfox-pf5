<?php
namespace Phpfox\Auth;


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
 * @package Phpfox\AuthManger
 */
class AuthResult
{

    const SUCCESS = 1;

    const MISSING_IDENTITY = 2;

    const INVALID_IDENTITY = 3;

    const MISSING_CREDENTIAL = 4;

    const INVALID_CREDENTIAL = 5;

    const UN_CATEGORIZE = 6;

    /**
     * @var int
     */
    private $code = -1;

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
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
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
        return $this;
    }
}