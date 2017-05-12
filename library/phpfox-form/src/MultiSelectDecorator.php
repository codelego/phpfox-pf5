<?php

namespace Phpfox\Form;


class MultiSelectDecorator implements DecoratorInterface
{
    /**
     * @param InputRadioField $element
     *
     * @return string
     */
    public function render($element)
    {
        $values = $element->getValue();
        $attributes = $element->getAttributes();
        $attributes['name'] = $element->getName() . '[]';


        $optionHtml = array_map(function ($option) use ($values) {
            $selected = in_array($option['value'], $values);
            return _sprintf('<option {selected} value="{value}" label="{label}">{label}</option>',
                [
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => $selected ? 'selected' : '',
                ]);
        }, $element->getOptions());

        $optionHtml = implode('', $optionHtml);

        return '<select multiple ' . _attrize($attributes) . '>' . $optionHtml
            . '</select>';
    }
}