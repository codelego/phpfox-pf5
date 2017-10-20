<?php

namespace Phpfox\Form;

use Phpfox\Error\MessageContainer;
use Phpfox\Validate\Validator;

class Form extends Element implements ElementInterface, CollectionInterface
{
    /**
     * @var ElementInterface[]
     */
    protected $byNames = [];

    /**
     * @var string
     */
    protected $decorator = 'form_panel';

    /**
     * @var string
     */
    protected $validatorClass;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var MessageContainer
     */
    protected $error;

    /**
     * @var ButtonField[]
     */
    protected $buttons = [];

    protected $attributes
        = [
            'method'  => 'post',
            'action'  => '',
            'enctype' => 'multipart/form-data',
        ];

    /**
     * @return ElementInterface[]
     */
    public function getElements()
    {
        return $this->byNames;
    }

    /**
     * @param string $name
     */
    public function removeElement($name)
    {
        unset($this->byNames[$name]);
    }

    /**
     * @param array $names
     */
    public function removeElements($names)
    {
        foreach ($names as $name) {
            unset($this->byNames[$name]);
        }
    }

    /**
     * @param array|ElementInterface[] $elements
     *
     * @return $this
     */
    public function addElements($elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
        return $this;
    }

    /**
     * @param array|ElementInterface $element
     *
     * @return $this
     */
    public function addElement($element)
    {
        if (!$element instanceof ElementInterface) {
            $element = \Phpfox::get('form.factory')->factory($element);
        }

        $element->setParent($this);
        $this->byNames[$element->getName()] = $element;

        return $this;
    }

    /**
     * @param array|ElementInterface $button
     *
     * @return $this
     */
    public function addButton($button)
    {
        if (!$button instanceof ElementInterface) {
            $button['factory'] = 'button';
            $button = \Phpfox::get('form.factory')->factory($button);
        }

        $button->setParent($this);
        $this->buttons[$button->getName()] = $button;

        return $this;
    }

    /**
     * @param string $name
     */
    public function removeButton($name)
    {
        $this->buttons[$name];
    }

    /**
     * @param string $name
     *
     * @return null|ElementInterface
     */
    public function getElement($name)
    {
        return isset($this->byNames[$name]) ? $this->byNames[$name] : null;
    }

    /**
     * @return string
     */
    public function open()
    {
        if (!isset($this->attributes['method'])) {
            $this->setAttribute('method', 'POST');
        }
        return '<form ' . _attrize($this->attributes) . '>';
    }

    /**
     * @return string
     */
    public function close()
    {
        return '</form>';
    }

    /**
     * @param array|mixed $data
     *
     * @return bool
     */
    public function populate($data)
    {
        $this->beforePopulate($data);
        foreach ($this->byNames as $name => $element) {
            if (isset($data[$name]) && $element instanceof FieldInterface) {
                $element->setValue($data[$name]);
            }
        }
        $this->afterPopulate();
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
     * @return boolean
     */
    public function isValid($data)
    {
        $this->populate($data);
        $validator = $this->getValidator();
        if ($validator instanceof Validator) {
            return $this->validator->isValid($data, $this->getError());
        }
        return true;
    }

    /**
     * Get error message container
     *
     * @return MessageContainer
     */
    public function getError()
    {
        if (null == $this->error) {
            $this->error = new MessageContainer();
        }
        return $this->error;
    }

    /**
     * @param string $group
     * @param string $messages
     */
    public function addError($group, $messages)
    {
        $this->getError()->add($group, $messages);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getErrorHtml($type)
    {
        if ($this->getError()->isValid()) {
            return '';
        }

        return \Phpfox::get('error_formater')->format($this->getError(), $type);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = [];

        $this->beforeGetData();
        foreach ($this->byNames as $name => $element) {
            if ($element instanceof FieldInterface) {
                $data[$name] = $element->getValue();
            }
        }

        $this->afterGetData($data);

        return $data;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->setAttribute('action', (string)$action);
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return (string)$this->getAttribute('action');
    }

    /**
     * Values get, post, put, delete, options, head
     *
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->setAttribute('method', strtolower($method));
    }

    /**
     * Result get, post, put, delete, options, head
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->getAttribute('method', 'get');
    }

    /**
     * Values application/x-www-form-urlencoded, multipart/form-data, text/plain, upload
     *
     * @param string $enctype
     */
    public function setEncType($enctype)
    {

        if ($enctype == 'upload') {
            $enctype = 'multipart/form-data';
        }

        $this->setAttribute('enctype', strtolower($enctype));
    }

    /**
     * Result is application/x-www-form-urlencoded, multipart/form-data,
     * text/plain
     *
     * @return string
     */
    public function getEncType()
    {
        return $this->getAttribute('enctype', 'text/plain');
    }

    /**
     * @return ButtonField[]
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @param string $name
     *
     * @return ButtonField
     */
    public function getButton($name)
    {
        return $this->buttons[$name];
    }

    /**
     * reset all buttons
     */
    public function resetButtons()
    {
        $this->buttons = [];
    }

    /**
     * @param array $data
     */
    protected function beforePopulate(&$data)
    {

    }

    /**
     * this method called after populate
     */
    protected function afterPopulate()
    {

    }

    /**
     * this method call before getData
     */
    protected function beforeGetData()
    {

    }

    /**
     * @param array $data
     */
    protected function afterGetData(&$data)
    {

    }
}