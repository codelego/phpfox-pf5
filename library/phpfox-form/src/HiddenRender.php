<?php

namespace Phpfox\Form;


class HiddenRender implements RenderInterface
{
    /**
     * @param Hidden $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();

        $attributes['type'] = 'hidden';
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