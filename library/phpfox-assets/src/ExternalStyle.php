<?php

namespace Phpfox\Assets;

class ExternalStyle implements HtmlElementInterface
{
    use HtmlSimpleTrait;

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     */
    public function add($key, $path = null, $props = [])
    {
        if (!$path) {
            $path = \Phpfox::getParam('static.css', $key);
        }

        if ($this->ensureKey($path)) {
            return;
        }

        $props = array_merge([
            'type' => 'text/css',
            'rel'  => 'stylesheet',
            'href' => $path,
        ], $props);


        $this->_append($key, $props);
    }

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     */
    public function prepend($key, $path = null, $props = [])
    {
        if (!$path) {
            $path = \Phpfox::getParam('static.css', $key);
        }

        if ($this->ensureKey($path)) {
            return;
        }

        $props = array_merge([
            'type' => 'text/css',
            'rel'  => 'stylesheet',
            'href' => $path,
        ], $props);

        $this->_prepend($key, $props);

    }

    public function getHtml()
    {
        $base = _get('layouts')->getStyleBaseUrl();

        return implode(PHP_EOL, array_map(function ($v) use ($base) {
            $v['href'] = str_replace('@css', $base, $v['href']);
            return _sprintf('<{0} {1}/>', ['link', _attrize($v)]);
        }, $this->data));
    }
}