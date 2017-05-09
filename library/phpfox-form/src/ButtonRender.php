<?php

namespace Phpfox\Form;


class ButtonRender implements RenderInterface
{
    /**
     * @param ButtonField $element
     *
     * @return string
     */
    public function render($element)
    {
        $href = $element->getParam('href');
        $attributes = $element->getAttributes();

        if ($href) {
            return '<a href="' . $href . '" ' . _attrize($attributes) . '>' . $element->getLabel() . '</a>';
        }

        $attributes['value'] = $element->getValue();

        return '<button ' . _attrize($attributes) . '>' . $element->getLabel() . '</button>';
    }

}