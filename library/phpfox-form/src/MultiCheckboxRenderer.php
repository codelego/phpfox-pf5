<?php

namespace Phpfox\Form;

class MultiCheckboxRender implements RenderInterface
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