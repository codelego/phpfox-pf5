<?php

namespace Phpfox\Form;


class RadioRender implements RenderInterface
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

        $optionHtml = [];
        foreach ($element->getOptions() as $option) {
            $selected = $option['value'] == $value;
            $help = (isset($option['note']) and !empty($option['note']))
                ? '<p class="help-block">' . $option['note'] . '</p>' : '';
            $optionHtml[]
                = _sprintf('<div class="radio"><label><input {selected} type="radio" name="{name}" value="{value}" />{label}</label>{help}</div>',
                [
                    'name'     => $name,
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => $selected ? 'checked' : '',
                    'help'     => $help,
                ]);
        }

        return implode('', $optionHtml);
    }
}