<?php

namespace Phpfox\Form;


trait CollectionTrait
{
    /**
     * @var ElementInterface[]
     */
    protected $byNames = [];


    public function getElements()
    {
        return $this->byNames;
    }

    public function addElement(ElementInterface $element)
    {
        $this->byNames[$element->getName()] = $element->setParent($this);

        return $this;
    }

    public function getElement($name)
    {
        return isset($this->byNames[$name]) ? $this->byNames[$name] : null;
    }
}