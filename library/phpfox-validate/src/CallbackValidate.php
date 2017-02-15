<?php

namespace Phpfox\Validate;

class CallbackValidate extends Validate
{
    /**
     * @var \Closure
     */
    protected $callable;

    /**
     * @return \Closure
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * @param \Closure $callable
     */
    public function setCallable($callable)
    {
        $this->callable = $callable;
    }

    public function isValid($value)
    {
        $this->setValue($value);

        $callback = $this->callable;

        if ($callback instanceof \Closure) {
            return $callback($value);
        }

        if (is_callable($callback)) {
            return call_user_func($callback, $value);
        }

        return true;
    }
}