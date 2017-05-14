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

    public function addElements($elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
        return $this;
    }

    public function addElement($element)
    {
        if (!$element instanceof ElementInterface) {
            $element = _get('form.factory')->factory($element);
        }

        $this->byNames[$element->getName()] = $element->setParent($this);

        return $this;
    }

    public function getElement($name)
    {
        return isset($this->byNames[$name]) ? $this->byNames[$name] : null;
    }
}