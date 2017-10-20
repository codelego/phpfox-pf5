<?php

namespace Phpfox\Form;


interface DecoratorInterface
{
    /**
     * @param $element
     *
     * @return string
     */
    public function render($element);
}