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

        return '<select ' . _attrize($attributes) . '></select>';
    }

}