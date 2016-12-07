<?php
namespace Phpfox\Form;

class Form extends Element implements CollectionInterface
{
    use CollectionTrait;

    protected $render = 'form_bootstrap';

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

    public function bind($data)
    {

    }

    public function getData()
    {

    }
}