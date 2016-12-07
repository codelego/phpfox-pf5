<?php

namespace Phpfox\Form;

interface FieldInterface extends ElementInterface
{

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value);
}