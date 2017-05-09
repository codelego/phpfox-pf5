<?php

namespace Phpfox\Form;


class SelectRender implements RenderInterface
{
    /**
     * @param ChoiceField $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        $attributes['name'] = $element->getName();
        $value = $element->getValue();
        $options = $element->getOptions();


        if (!$element->isRequired()) {
            array_unshift($options, [
                'value' => '',
                'label' => $element->getAttribute('placeholder'),
            ]);
        }
        $optionHtml = array_map(function ($option) use ($value) {
            return _sprintf('<option value="{value}" {selected}>{label}</option>',
                [
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => ($option['value'] and ($value == $option['value'])) ? 'selected' : '',
                ]);
        }, $options);


        $optionHtml = implode('', $optionHtml);

        return '<select ' . _attrize($attributes) . '>' . $optionHtml
            . '</select>';
    }

}