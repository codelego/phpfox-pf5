<?php

namespace Phpfox\View;


class StaticHtml implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $html
     */
    public function add($html)
    {
        $this->data[] = (string)$html;
    }

    /**
     * Clear all contents
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * getHtml content
     *
     * @return string
     */
    public function getHtml()
    {
        return implode(PHP_EOL, $this->data);
    }
}