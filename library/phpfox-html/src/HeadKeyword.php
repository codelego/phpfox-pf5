<?php

namespace Phpfox\Html;

/**
 * Class HeadKeyword
 *
 * @package Phpfox\Html
 */
class HeadKeyword implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string|array $data
     *
     * @return $this
     */
    public function set($data)
    {
        $this->data[] = is_string($data) ? [$data] : $data;
        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->data;
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
        return '<meta name="keywords" content="' . $this->__toString() . '"/>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return htmlentities(implode(',', $this->data));
    }
}