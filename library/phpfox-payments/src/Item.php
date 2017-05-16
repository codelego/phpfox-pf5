<?php

namespace Phpfox\Payments;

class Item implements ItemInterface
{
    /**
     * @var Parameters
     */
    protected $parameters;


    public function __construct($params = [])
    {
        $this->parameters = new Parameters($params);
        if (is_array($params)) {
            $this->initialize($params);
        }
    }

    public function initialize($params)
    {
        foreach ($params as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            }
        }
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
