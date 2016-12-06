<?php

namespace Phpfox\Form;


interface FieldsetInterface extends ElementInterface, FieldInterface
{
    public function addElement(ElementInterface $element);

    /**
     * @param  string $name
     *
     * @return ElementInterface
     */
    public function getElement($name);

    /**
     * @return ElementInterface[]
     */
    public function getElements();
}
