<?php

namespace Phpfox\Form;

class MultiCheckboxRenderer implements RendererInterface
{
    /**
     * @param MultiCheckbox $element
     *
     * @return string
     */
    public function render($element)
    {
        return 'multi_checkbox';
    }
}