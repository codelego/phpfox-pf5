<?php

namespace Phpfox\Form;


class RadioRender implements RenderInterface
{
    /**
     * @param Choice $element
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
            $optionHtml[]
                = _sprintf('<div class="radio"><label><input {selected} type="radio" name="{name}" value="{value}" />{label}</label></div>',
                [
                    'name'     => $name,
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => $selected ? 'checked' : '',
                ]);
        }

        return implode('', $optionHtml);
    }
}