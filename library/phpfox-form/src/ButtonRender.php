<?php

namespace Phpfox\Form;

class ButtonRenderer implements RendererInterface
{
    /**
     * @var string
     */
    protected $type = 'button';

    /**
     * @param Button $element
     *
     * @return string
     */
    public function render($element)
    {
        return _sprintf('<button name="$2" $3>$4</button>', [
            $this->type,
            $element->getName(),
            _attrize($element->getAttributes()),
            $element->getOption('label'),
        ]);
    }
}