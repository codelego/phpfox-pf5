<?php

namespace Phpfox\Assets;

class HeadOpenGraph implements HtmlElementInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param string $property
     * @param string $value
     */
    public function add($property, $value)
    {
        $this->data[$property] = $value;
    }

    /**
     * @param string $property
     *
     */
    public function remove($property)
    {
        unset($this->data[$property]);
    }

    public function clear()
    {
        $this->data = [];
    }

    public function getHtml()
    {
        if (empty($this->data)) {
            return '';
        }

        $result = [];
        foreach ($this->data as $key => $value) {
            $result[] = sprintf('<meta property="%s" content="%s" />', $key,
                $value);
        }

        return implode(PHP_EOL, $result);
    }
}