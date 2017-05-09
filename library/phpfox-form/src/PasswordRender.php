<?php

namespace Phpfox\Form;


class PasswordRender implements RenderInterface
{
    /**
     * @param InputTextField $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();

        $attributes['type'] = 'password';
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