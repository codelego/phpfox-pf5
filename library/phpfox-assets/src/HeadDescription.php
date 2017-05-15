<?php

namespace Phpfox\Assets;

class HeadDescription implements HtmlElementInterface
{

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param string $description
     */
    public function set($description)
    {
        $this->data = [$description];
    }

    /**
     * @param string $description
     */
    public function add($description)
    {
        $this->data[] = $description;
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
        return htmlentities(implode(',', $this->data));
    }

    public function getHtml()
    {
        if (empty($this->data)) {
            return '';
        }
        return '<meta name="description" content="' . htmlentities(implode(',',
                $this->data)) . '"/>';
    }

}