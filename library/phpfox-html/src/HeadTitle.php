<?php

namespace Phpfox\Html;

/**
 * Class HeadTitle
 *
 * Control content of &gt;title&lt; tag.
 *
 * @package Phpfox\Html
 */
class HeadTitle implements HtmlElementInterface
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $separator = ' &raquo; ';

    /**
     * @param string|array $title
     *
     * @return $this
     */
    public function set($title)
    {
        if (is_string($title)) {
            $this->data = [$title];
        } else {
            $this->data [] = $title;
        }
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
        return '<title>' . $this->__toString() . '</title>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $response = [];

        foreach ($this->data as $string) {
            $response[] = $string;
        }

        return implode($this->separator, $response);
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