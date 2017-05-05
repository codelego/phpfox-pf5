<?php

namespace Phpfox\Form;

class StaticRender implements RenderInterface
{
    /**
     * @param StaticField $element
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