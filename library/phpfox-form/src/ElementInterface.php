<?php

namespace Phpfox\Form;


interface ElementInterface
{
    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getOption($name);

    /**
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setOption($name, $value);

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param string $options
     *
     * @return $this
     */
    public function setOptions($options);

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
}