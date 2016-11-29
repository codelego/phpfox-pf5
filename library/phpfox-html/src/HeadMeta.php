<?php

namespace Phpfox\Html;

/**
 * Class HeadMeta
 *
 * @package Phpfox\Html
 */
class HeadMeta implements HtmlElementInterface
{

    use HtmlSimpleTrait;

    /**
     * @param string $name
     * @param array  $props
     *
     * @return $this
     */
    public function add($name, $props = [])
    {
        $this->data[$name] = $props;
        return $this;
    }


    /**
     * @return string
     */
    public function getHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return '<meta ' . _attrize($v) . '/>';
        }, $this->data));
    }
}