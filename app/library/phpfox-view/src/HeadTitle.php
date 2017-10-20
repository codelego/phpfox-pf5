<?php

namespace Phpfox\View;

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
     *
     * @return $this
     */
    public function set($title)
    {
        $this->data = [$title];
        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function add($title)
    {
        $this->data[] = $title;
        return $this;
    }

    /**
     * Empty title string
     *
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
            $this->data = [\Phpfox::setting('core.site_title')];
        }
        return '<title>' . $this->__toString() . '</title>';
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return implode($this->separator, $this->data);
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