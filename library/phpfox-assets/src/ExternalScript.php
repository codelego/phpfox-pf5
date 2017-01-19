<?php

namespace Phpfox\Assets;

use Phpfox;

class ExternalScript implements HtmlElementInterface
{
    use HtmlSimpleTrait;

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     */
    public function add($key, $path, $props = [])
    {
        if (!$path) {
            $path = Phpfox::getParam('static.js', $key);
        }

        if (substr($path, 0, 2) != '//') {
            $path = $this->getUrl($path);
        }

        if ($this->ensureKey($path)) {
            return;
        }

        $props = array_merge([
            'type' => 'text/javascript',
            'src'  => $path,
        ], $props);

        $this->_append($key, $props);
    }

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     *
     */
    public function prepend($key, $path, $props = [])
    {
        if (!$path) {
            $path = \Phpfox::getParam('static.js', $key);
        }

        if ($this->ensureKey($path)) {
            return;
        }

        if (substr($path, 0, 2) != '//') {
            $path = $this->getUrl($path);
        }

        $props = array_merge([
            'type' => 'text/javascript',
            'src'  => $path,
        ], $props);

        $this->_prepend($key, $props);

    }

    public function getHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return _sprintf('<{0} {1}></{0}>', ['script', _attrize($v)]);
        }, $this->data));
    }
}