<?php

namespace Phpfox\Assets;

/**
 * Class HeadMeta
 *
 * @package Phpfox\Html
 */
class HeadMeta implements HtmlElementInterface
{

    use HtmlSimpleTrait;

    public function __construct()
    {
        $this->data[] = ['charset' => 'utf-8'];
        $this->data[] = ['name'    => 'viewport',
                         'content' => 'width=device-width, initial-scale=1.0 user-scalable=yes',
        ];
    }

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