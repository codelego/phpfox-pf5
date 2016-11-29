<?php

namespace Phpfox\Html;


class Breadcrumb implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $elements = [];

    public function prepend($item)
    {
        array_unshift($this->elements, $item);
        return $this;
    }

    public function append($item)
    {
        $this->elements[] = $item;
        return $this;
    }

    public function getHtml()
    {
        return '';
    }

    public function clear()
    {
        $this->elements = [];
    }
}