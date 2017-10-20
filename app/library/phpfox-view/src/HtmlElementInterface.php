<?php

namespace Phpfox\View;


interface HtmlElementInterface
{
    /**
     * @return string
     */
    public function getHtml();

    /**
     * Reset data
     */
    public function clear();
}