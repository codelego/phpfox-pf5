<?php

namespace Phpfox\Form;

interface CollectionInterface
{
    /**
     * @var FieldInterface[]
     */
    public function getElements();

    /**
     * @param ElementInterface|array $element
     *
     * @return $this
     */
    public function addElement($element);

    /**
     * @param array|ElementInterface[] $elements
     *
     * @return mixed
     */
    public function addElements($elements);

    /**
     * @param string $name
     *
     * @return ElementInterface|FieldInterface|null
     */
    public function getElement($name);
}