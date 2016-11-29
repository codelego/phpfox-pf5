<?php

namespace Phpfox\Form;


interface RendererInterface
{
    /**
     * @param $element
     *
     * @return string
     */
    public function render($element);
}