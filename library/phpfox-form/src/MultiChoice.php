<?php

namespace Phpfox\Form;

class MultiChoice implements ElementInterface
{
    use ElementTrait;

    /**
     * @var array
     */
    protected $value = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}