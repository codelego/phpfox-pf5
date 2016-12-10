<?php

namespace Phpfox\Assets;

/**
 * Class HeadOpenGraph
 *
 * @package Phpfox\Html
 */
class HeadOpenGraph implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $property
     * @param string $value
     */
    public function set($property, $value)
    {
        $this->data[$property] = $value;
    }

    /**
     * @param string $property
     *
     * @return $this
     */
    public function remove($property)
    {
        if (isset($this->data[$property])) {
            unset($this->data[$property]);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->data = [];
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        if (empty($this->data)) {
            return '';
        }

        $result = [];
        foreach ($this->data as $key => $value) {
            $result[] = sprintf('<meta property="%s" content="%s" />', $key,
                $value);
        }

        return implode(PHP_EOL, $result);
    }
}