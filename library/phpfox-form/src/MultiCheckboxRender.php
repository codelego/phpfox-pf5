<?php

namespace Phpfox\Form;


class MultiCheckboxRender implements RenderInterface
{
    /**
     * @param MultiCheckboxField $element
     *
     * @return string
     */
    public function render($element)
    {
        $name = $element->getName();
        $values = $element->getValue();

        $isInline = $element->getParam('inline', false);

        $optionHtml = array_map(function ($option) use ($name, $values, $isInline) {
            $checked = in_array($option['value'], $values);
            $help = (isset($option['note']) and !empty($option['note']))
                ? '<p class="help-block">' . $option['note'] . '</p>' : '';

            if ($isInline) {
                return _sprintf('<label class="checkbox-inline"><input {checked} type="checkbox" name="{name}[]" value="{value}" />{label}</label>{help}',
                    [
                        'name'    => $name,
                        'label'   => $option['label'],
                        'value'   => $option['value'],
                        'checked' => $checked ? 'checked' : '',
                        'help'    => $help,
                    ]);
            }

            return _sprintf('<div class="checkbox"><label><input {checked} type="checkbox" name="{name}[]" value="{value}" />{label}</label>{help}</div>',
                [
                    'name'    => $name,
                    'label'   => $option['label'],
                    'value'   => $option['value'],
                    'checked' => $checked ? 'checked' : '',
                    'help'    => $help,
                ]);
        }, $element->getOptions());


        return implode('', $optionHtml);
    }
}