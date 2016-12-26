<?php

namespace Phpfox\Assets;

class HeadMeta implements HtmlElementInterface
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $name
     * @param array  $props
     */
    public function add($name, $props = [])
    {
        $this->data[$name] = $props;
    }

    public function clear()
    {
        $this->data = [];
    }


    /**
     * @return string
     */
    public function getHtml()
    {
        if (!$this->data) {
            return '';
        }
        return implode(PHP_EOL, array_map(function ($v) {
            return '<meta ' . _attrize($v) . '/>';
        }, $this->data));
    }
}