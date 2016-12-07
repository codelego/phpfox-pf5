<?php

namespace Phpfox\Form;


class InputRender implements RenderInterface
{
    /**
     * @param Text $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();

        if (empty($attributes['type'])) {
            $attributes['type'] = 'text';
        }
        $attributes['value'] = $element->getValue();

        if (!$element->isRequired()) {
            unset($attributes['required']);
        } else {
            $attributes['required'] = true;
        }

        return '<input ' . _attrize($attributes) . '/>';
    }
}