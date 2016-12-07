<?php

namespace Phpfox\Form;

interface CollectionInterface
{
    /**
     * @var FieldInterface[]
     */
    public function getElements();

    /**
     * @param ElementInterface $element
     *
     * @return $this
     */
    public function addElement(ElementInterface $element);

    /**
     * @param string $name
     *
     * @return ElementInterface|FieldInterface|null
     */
    public function getElement($name);
}