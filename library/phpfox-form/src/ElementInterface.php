<?php

namespace Phpfox\Form;


interface ElementInterface
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
     * @return string
     */
    public function getRender();

    /**
     * @param $render
     *
     * @return $this
     */
    public function setRender($render);

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getParam($name, $default = null);

    /**
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam($name, $value);

    /**
     * @return array
     */
    public function getParams();

    /**
     * @param array $params
     */
    public function setParams($params);

    /**
     * @return array
     */
    public function getAttributes();

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes);

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function setAttribute($name, $value);


    /**
     * @param string $name
     *
     * @return string
     */
    public function getAttribute($name);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute($name);

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

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     */
    public function setLabel($label);

    /**
     * @return bool
     */
    public function noLabel();
}