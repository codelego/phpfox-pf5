<?php

namespace Phpfox\Form;

class StaticTextRender implements RenderInterface
{
    /**
     * @param StaticText $element
     *
     * @return string
     */
    public function render($element)
    {
        $name = $element->getName();
        $value = $element->getValue();
        $input = '<textarea class="hidden" name="' . $name . '">' . $value . '</textarea>';
        $text = '<p class="form-control-static">' . $value . '</p>';
        return $text . $input;
    }
}