<?php

namespace Phpfox\Form;

/**
 * Interface ElementInterface
 *
 * @package Phpfox\Form
 */
interface FieldInterface extends ElementInterface
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

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

    /**
     * @return CollectionInterface
     */
    public function getParent();

    /**
     * @param CollectionInterface $parent
     *
     * @return $this
     */
    public function setParent($parent);
}