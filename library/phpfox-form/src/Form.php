<?php
namespace Phpfox\Form;

use Phpfox\Validate\Validator;

class Form extends Element implements ElementInterface, CollectionInterface
{
    /**
     * @var ElementInterface[]
     */
    protected $byNames = [];

    protected $render = 'form_bootstrap';

    /**
     * @var string
     */
    protected $validatorClass;

    /**
     * @var Validator
     */
    protected $validator;

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
        return true;
    }

    /**
     * @return Validator|null
     */
    public function getValidator()
    {
        if (!$this->validator and $this->validatorClass) {
            $this->validator = new $this->validatorClass;
        }
        return $this->validator;
    }

    /**
     * @param Validator $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     *
     * @return false
     */
    public function isValid($data)
    {
        $this->populate($data);
        if ($this->validator) {
            return $this->validator->isValid($data);
        }
        return true;
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