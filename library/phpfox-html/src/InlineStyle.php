<?php

namespace Phpfox\Html;

/**
 * Class InlineStyle
 *
 * @package Phpfox\Html
 */
class InlineStyle implements HtmlElementInterface
{
    use HtmlSimpleTrait;

    /**
     * Append inline scripts to header
     *
     * @param string $key
     * @param string $script
     *
     * @return $this
     */
    public function append($key, $script)
    {
        if ($this->ensureKey($script)) {
            return $this;
        }

        $this->_append($key, $script);

        return $this;
    }

    /**
     * @param string $key
     * @param string $script
     *
     * @return $this
     */
    public function prepend($key, $script)
    {
        if ($this->ensureKey($script)) {
            return $this;
        }

        $this->_prepend($key, $script);

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        if (!$this->data) {
            return '';
        }
        return _sprintf('<{0} type="{1}">{2}</{0}>', [
            'script',
            'text/css',
            implode(';', $this->data),
        ]);
    }
}