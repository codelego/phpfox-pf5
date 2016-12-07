<?php

namespace Phpfox\Payments;


class Item implements ItemInterface
{
    /**
     * @var ParameterBag
     */
    protected $parameters;

    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag($parameters);

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters->all();
    }

    public function getName()
    {
        return $this->getParameter('name');
    }

    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    public function getPrice()
    {
        return $this->getParameter('price');
    }

    public function setPrice($value)
    {
        return $this->setParameter('price', $value);
    }

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($value)
    {
        $this->parameters->set('code', $value);
    }
}
