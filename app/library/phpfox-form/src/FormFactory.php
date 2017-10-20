<?php

namespace Phpfox\Form;


class FormFactory
{
    /**
     * @param array $configs
     *
     * @return ElementInterface|CollectionInterface
     */
    public function factory($configs)
    {
        $id = isset($configs['factory']) ? $configs['factory'] : 'factory';
        $elements = isset($configs['elements']) ? $configs['elements'] : null;
        $class = _param('form.elements', $id);

        unset($configs['factory'], $configs['elements']);

        $element = new $class($configs);

        if ($elements and $element instanceof CollectionInterface) {
            foreach ($elements as $configs) {
                $element->addElement($this->factory($configs));
            }
        }

        return $element;
    }
}