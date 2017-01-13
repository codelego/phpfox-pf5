<?php

namespace Phpfox\Form;


class TextareaRender implements RenderInterface
{
    /**
     * @param Textarea $element
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        $attributes['name'] = $element->getName();

        if (!$element->isRequired()) {
            unset($attributes['required']);
        } else {
            $attributes['required'] = true;
        }

        return '<textarea ' . _attrize($attributes) . '>'.$element->getValue().'</textarea>';
    }
}