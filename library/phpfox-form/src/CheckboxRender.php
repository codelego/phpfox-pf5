<?php

namespace Phpfox\Form;


class CheckboxRender implements RenderInterface
{
    /**
     * @param CheckboxField $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        if ($element->isChecked()) {
            $attributes['checked'] = true;
        } else {
            unset($attributes['checked']);
        }

        if ($element->isRequired()) {
            $attributes['required'] = true;
        } else {
            unset($attributes['required']);
        }
        $attributes['type'] = $element->getParam('type', 'checkbox');
        $attributes['name'] = $element->getName();
        $attributes['value'] = $element->getParam('checkedValue', '1');

        return '<div class="checkbox"><label><input ' . _attrize($attributes)
            . '>' . $element->getLabel()
            . '</label></div>';
    }
}