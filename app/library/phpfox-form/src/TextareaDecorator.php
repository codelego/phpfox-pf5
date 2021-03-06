<?php

namespace Phpfox\Form;


class TextareaDecorator implements DecoratorInterface
{
    /**
     * @param TextareaField $element
     *
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

        return '<textarea ' . _attrize($attributes) . '>' . $element->getValue()
            . '</textarea>';
    }
}