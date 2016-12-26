<?php
namespace Phpfox\Form;

class Form extends Element implements ElementInterface, CollectionInterface
{
    /**
     * @var ElementInterface[]
     */
    protected $byNames = [];

    protected $render = 'form_bootstrap';

    public function getElements()
    {
        return $this->byNames;
    }

    public function addElements($elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    public function addElement($element)
    {
        if (!$element instanceof ElementInterface) {
            $element = \Phpfox::get('form.factory')->factory($element);
        }

        $element->setParent($this);
        $this->byNames[$element->getName()] = $element;
    }

    public function getElement($name)
    {
        return isset($this->byNames[$name]) ? $this->byNames[$name] : null;
    }

    public function open()
    {
        if (!isset($this->attributes['method'])) {
            $this->setAttribute('method', 'POST');
        }
        return '<form ' . _attrize($this->attributes) . '>';
    }

    public function close()
    {
        return '</form>';
    }

    public function populate($data)
    {
        foreach ($this->byNames as $name => $element) {
            if (isset($data[$name]) && $element instanceof FieldInterface) {
                $element->setValue($data[$name]);
            }
        }
    }

    public function getData()
    {

        $data = [];

        foreach ($this->byNames as $name => $element) {
            if ($element instanceof FieldInterface) {
                $data[$name] = $element->getValue();
            }
        }

        return $data;

    }
}