<?php

namespace Phpfox\Html;

/**
 * Class ExternalScript
 *
 * @package Phpfox\Html
 */
class ExternalScript implements HtmlElementInterface
{
    use HtmlSimpleTrait;

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     *
     * @return $this
     */
    public function append($key, $path, $props = [])
    {
        if ($this->ensureKey($path)) {
            return $this;
        }

        $props = array_merge([
            'type' => 'text/javascript',
            'src' => $path,
        ], $props);

        $this->_append($key, $props);

        return $this;
    }

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     *
     * @return $this
     */
    public function prepend($key, $path, $props = [])
    {
        if ($this->ensureKey($path)) {
            return $this;
        }

        $props = array_merge([
            'type' => 'text/javascript',
            'src' => $path,
        ], $props);

        $this->_prepend($key, $props);

        return $this;
    }

    public function getHtml()
    {
        return implode(PHP_EOL, array_map(function($v){
            return _sprintf('<{0} async {1}/></{0}>',['script', _attrize($v)]);
        },$this->data));
    }
}