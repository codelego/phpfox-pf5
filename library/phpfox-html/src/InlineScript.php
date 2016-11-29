<?php

namespace Phpfox\Html;

/**
 * Class InlineScript
 *
 * @package Phpfox\Html
 */
class InlineScript implements HtmlElementInterface
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
        return _sprintf('<{0} type="{1}">{2}</{0}>', [
            'script',
            'text/javascript',
            implode(';', $this->data),
        ]);
    }
}