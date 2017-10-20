<?php

namespace Phpfox\Validate;

class CallbackValidate extends Validate
{
    public function isValid($value)
    {
        $callable = $this->get('callable');

        if ($callable instanceof \Closure) {
            return $callable($value, $this);
        }

        if (is_callable($callable)) {
            return call_user_func($callable, $value, $this);
        }

        return true;
    }
}