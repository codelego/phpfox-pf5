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
        $value = $element->getValue();
        $optionHtml = [];
        $options = $element->getOptions();


        if (!$element->isRequired()) {
            array_unshift($options, [
                'value' => '',
                'label' => $element->getAttribute('placeholder'),
            ]);
        }
        foreach ($options as $option) {
            $optionHtml[]
                = _sprintf('<option value="{value}" {selected}>{label}</option>',
                [
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => ($value == $option['value']) ? 'selected'
                        : '',
                ]);
        }

        $optionHtml = implode('', $optionHtml);

        return '<select ' . _attrize($attributes) . '>' . $optionHtml
            . '</select>';
    }

}