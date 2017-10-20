<?php

namespace Phpfox\Form;


class InputDecorator implements DecoratorInterface
{
    /**
     * @param InputTextField $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        $attributes['value'] = $element->getValue();
        $attributes['name'] = $element->getName();
        if (!$element->isRequired()) {
            unset($attributes['required']);
        } else {
            $attributes['required'] = true;
        }

        return '<input ' . _attrize($attributes) . '/>';
    }
}