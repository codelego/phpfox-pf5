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

    const MISSING_IDENTITY = 8;

    const MISSING_CREDENTIAL = 16;

    /**
     * @var int
     */
    private $code = 5;

    /**
     * @var int
     */
    private $identity = 0;

    /**
     * @var string
     */
    private $message;

    /**
     * @param int         $code
     * @param string|null $message
     *
     * @throws \InvalidArgumentException
     */
    public function setResult($code, $message = null)
    {
        $code = intval($code);

        switch ($code) {
            case self::SUCCESS:
            case self::INVALID_CREDENTIAL:
            case self::INVALID_IDENTITY:
            case self::MISSING_CREDENTIAL:
            case self::MISSING_IDENTITY:
            case self::UN_CATEGORIZE:
                $this->code = $code;
                break;
            default :
                throw new \InvalidArgumentException("Invalid Auth Result");

        }
        $this->message = $message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        if (null == $this->message) {
            $this->message = $this->getDefaultMessage();
        }
        return $this->message;
    }

    protected function getDefaultMessage()
    {
        $defaults = [
            self::SUCCESS            => 'Logged in successful.',
            self::INVALID_CREDENTIAL => 'Incorrect password.',
            self::INVALID_IDENTITY   => 'Invalid login information.',
            self::UN_CATEGORIZE      => 'Invalid login information.',
            self::MISSING_IDENTITY   => 'Missing login information.',
            self::MISSING_CREDENTIAL => 'Missing login information.',
            'default'                => 'Invalid login information.',
        ];
        return _text($defaults[isset($defaults[$this->code]) ? $this->code
            : 'default']);
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
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    public function isValid()
    {
        return $this->code == self::SUCCESS && $this->identity > 0;
    }
}