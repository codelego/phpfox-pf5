<?php

namespace Phpfox\Form;


Trait MultiOptions
{
    /**
     * @var array
     */
    protected $multiOptions = [];

    /**
     * @return array
     */
    public function getMultiOptions()
    {
        return $this->multiOptions;
    }

    /**
     * @param array $multiOptions
     */
    public function setMultiOptions($multiOptions)
    {
        $this->multiOptions = $multiOptions;
    }
}