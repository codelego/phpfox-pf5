<?php

namespace Phpfox\Assets;

class HeadTitle implements HtmlElementInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $separator = ' &raquo; ';

    /**
     * @param string $title
     */
    public function set($title)
    {
        $this->data = [$title];
    }

    /**
     * @param string $title
     */
    public function add($title)
    {
        $this->data[] = $title;
    }

    /**
     * Empty title string
     *
     * @return $this
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        if (empty($this->data)) {
            return '';
        }

        return '<title>' . $this->__toString() . '</title>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode($this->separator, $this->data);
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @param string $separator
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }
}