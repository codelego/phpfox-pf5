<?php

namespace Phpfox\Assets;

/**
 * Class ExternalStyle
 *
 * @package Phpfox\Html
 */
class ExternalStyle implements HtmlElementInterface
{
    use HtmlSimpleTrait;

    /**
     * @param string $key
     * @param string $path
     * @param array  $props
     *
     * @return $this
     */
    public function add($key, $path = null, $props = [])
    {
        if (!$path) {
            $path = \Phpfox::getParam('static.css', $key);
        }

        if ($this->ensureKey($path)) {
            return $this;
        }

        if (substr($path, 0, 2) != '//') {
            $path = $this->getUrl($path);
        }

        $props = array_merge([
            'type' => 'text/css',
            'rel'  => 'stylesheet',
            'href' => $path,
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
    public function prepend($key, $path = null, $props = [])
    {
        if (!$path) {
            $path = \Phpfox::getParam('static.css', $key);
        }

        if ($this->ensureKey($path)) {
            return $this;
        }

        if (substr($path, 0, 2) != '//') {
            $path = $this->getUrl($path);
        }

        $props = array_merge([
            'type' => 'text/css',
            'rel'  => 'stylesheet',
            'href' => $path,
        ], $props);

        $this->_prepend($key, $props);

        return $this;
    }

    public function getHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return _sprintf('<{0} {1}/>', ['link', _attrize($v)]);
        }, $this->data));
    }
}