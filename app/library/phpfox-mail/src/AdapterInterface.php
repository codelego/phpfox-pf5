<?php

namespace Phpfox\Mailer;


interface AdapterInterface
{
    /**
     * @param Message $msg
     *
     * @return bool
     */
    public function send(Message $msg);

    /**
     * Release resource, It's helpful when running a long task.
     */
    public function release();

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $msg
     */
    public function addError($msg);

    /**
     * @return string
     */
    public function getErrors();

    /**
     * @return string
     */
    public function clearErrors();

    /**
     * @return boolean
     */
    public function isDebug();

    /**
     * @param boolean $isDebug
     *
     * @return
     */
    public function setDebug($isDebug);
}