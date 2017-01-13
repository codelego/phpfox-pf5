<?php

namespace Phpfox\Form;


class SelectRender implements RenderInterface
{
    /**
     * @param Choice $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        $attributes['name'] = $element->getName();

        $optionHtml = [];
        foreach ($element->getOptions() as $option) {
            $optionHtml[] = _sprintf('<option value="{value}">{label}</option>',
                $option);
        }

        $optionHtml = implode('', $optionHtml);

        return '<select ' . _attrize($attributes) . '>'.$optionHtml.'</select>';
    }

}