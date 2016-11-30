<?php

namespace Phpfox\Html;

class HeadDescription implements HtmlElementInterface
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
        $this->data = is_string($data) ? [$data] : $data;
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
        return '<meta name="description" content="' . htmlentities(implode(',',
                $this->data)) . '"/>';
    }

}