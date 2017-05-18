<?php

namespace Phpfox\View;

class InlineScript implements HtmlElementInterface
{

    /**
     * @var string[]
     */
    private $data = [];


    /**
     * Append inline scripts to header
     *
     * @param string $script
     */
    public function add($script)
    {
        $this->data[] = $script;
    }

    /**
     * @param string $script
     *
     */
    public function prepend($script)
    {
        array_unshift($this->data, $script);
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
        if (!$this->data) {
            return '';
        }

        return _sprintf('<{0} type="{1}">{2}</{0}>', [
            'script',
            'text/javascript',
            implode(';', $this->data),
        ]);
    }
}