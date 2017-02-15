<?php

namespace Phpfox\Validate;


interface ValidateInterface
{
    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     */
    public function setMessage($message);

    /**
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getError();

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isValid($value);

    /**
     * @return bool
     */
    public function isSkipAll();

    /**
     * @param bool $flag
     */
    public function setSkipAll($flag);

    /**
     * @return bool
     */
    public function isSkip();

    /**
     * @param bool $flag
     */
    public function setSkip($flag);

    /**
     * @param array $params
     */
    public function initialize($params);
}