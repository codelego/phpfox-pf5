<?php

namespace Phpfox\View;


class RequireCss
{
    protected $_paths = [];

    /**
     * @var array
     */
    protected $_deps = [];

    /**
     * @param string $key
     *
     * @return $this
     */
    public function add($key)
    {
        $this->_deps [] = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return '';
    }

    public function __toString()
    {
        return $this->getHtml();
    }
}