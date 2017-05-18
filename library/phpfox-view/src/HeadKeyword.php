<?php

namespace Phpfox\View;

class HeadKeyword implements HtmlElementInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param string $keyword
     */
    public function set($keyword)
    {
        $this->data = [$keyword];
    }

    public function add($keyword)
    {
        $this->data[] = $keyword;
    }

    public function clear()
    {
        $this->data = [];
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return htmlentities(implode(', ', $this->data));
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        if (empty($this->data)) {
            return '';
        }

        return '<meta name="keywords" content="' . $this->__toString() . '"/>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return htmlentities(implode(', ', $this->data));
    }
}