<?php

namespace Phpfox\Assets;


class Breadcrumb implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $data = [];

    public function add($item)
    {
        array_unshift($this->data, $item);
    }

    public function append($item)
    {
        $this->data[] = $item;
    }

    public function getHtml()
    {
        return '';
    }

    public function clear()
    {
        $this->data = [];
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
}