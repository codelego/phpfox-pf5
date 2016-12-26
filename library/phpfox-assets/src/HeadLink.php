<?php

namespace Phpfox\Assets;

class HeadLink implements HtmlElementInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param array $props
     */
    public function add($props = [])
    {
        $this->data[] = $props;
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
        $response = [];
        foreach ($this->data as $attributes) {
            if (empty($attributes)) {
                continue;
            }
            $response[] = '<link ' . _attrize($attributes) . ' />';
        }

        return implode(PHP_EOL, $response);
    }
}