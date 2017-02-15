<?php

namespace Phpfox\Form;


class YesnoRender implements RenderInterface
{
    /**
     * @param ChoiceField $element
     *
     * @return string
     */
    public function render($element)
    {
        $name = $element->getName();
        $value = $element->getValue();
        $options = [
            ['label' => _text('Yes'), 'value' => 1],
            ['label' => _text('No'), 'value' => 0],
        ];

        $optionHtml = [];
        foreach ($options as $option) {
            $selected = $option['value'] == $value;
            $optionHtml[]
                = _sprintf('<label class="radio-inline"><input {selected} type="radio" name="{name}" value="{value}" />{label}</label>',
                [
                    'name'     => $name,
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => $selected ? 'checked' : '',
                ]);
        }

        return '<div class="form-radio">' . implode('', $optionHtml) . '</div>';
    }
}