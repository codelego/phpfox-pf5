<?php

namespace Phpfox\Form;


class FileUploadDecorator implements DecoratorInterface
{
    /**
     * @param InputFileField $element
     *
     * @return string
     */
    public function render($element)
    {
        $attributes = $element->getAttributes();
        $attributes['type'] = 'file';
        $attributes['name'] = $element->getName();
        if (!$element->isRequired()) {
            unset($attributes['required']);
        } else {
            $attributes['required'] = true;
        }

        return '<input ' . _attrize($attributes) . '/>';
    }

}