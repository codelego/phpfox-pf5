<?php

namespace Phpfox\Form;


class InputRadioDecorator implements DecoratorInterface
{
    /**
     * @param InputRadioField $element
     *
     * @return string
     */
    public function render($element)
    {
        $name = $element->getName();
        $value = $element->getValue();

        $isInline = $element->getParam('inline', false);

        $optionHtml = array_map(function ($option) use ($name, $value, $isInline) {
            $selected = $option['value'] == $value;
            $help = (isset($option['note']) and !empty($option['note']))
                ? '<p class="control-note">' . $option['note'] . '</p>' : '';

            if ($isInline) {
                return _sprintf('<label class="radio-inline"><input {selected} {disabled} type="radio" name="{name}" value="{value}" />{label}</label>{help}',
                    [
                        'name'     => $name,
                        'label'    => $option['label'],
                        'value'    => $option['value'],
                        'selected' => $selected ? 'checked' : '',
                        'help'     => $help,
                        'disabled' => empty($option['disabled']) ? '' : 'disabled',
                    ]);
            }

            return _sprintf('<div class="radio"><label><input {selected} {disabled} type="radio" name="{name}" value="{value}" />{label}</label>{help}</div>',
                [
                    'name'     => $name,
                    'label'    => $option['label'],
                    'value'    => $option['value'],
                    'selected' => $selected ? 'checked' : '',
                    'help'     => $help,
                    'disabled' => empty($option['disabled']) ? '' : 'disabled',
                ]);
        }, $element->getOptions());


        return '<div>' . implode('', $optionHtml) . '</div>';
    }
}