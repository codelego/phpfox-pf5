<?php

namespace Phpfox\Form;

interface CollectionInterface extends FieldInterface
{
    /**
     * @var FieldInterface[]
     */
    public function getElements();

    /**
     * @param array $params
     *
     * @return $this
     */
    public function addElement($params);
}