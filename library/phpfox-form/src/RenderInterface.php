<?php

namespace Phpfox\Form;


interface RenderInterface
{
    /**
     * @param $element
     *
     * @return string
     */
    public function render($element);
}