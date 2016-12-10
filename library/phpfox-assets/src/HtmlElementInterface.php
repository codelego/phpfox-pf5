<?php

namespace Phpfox\Assets;


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