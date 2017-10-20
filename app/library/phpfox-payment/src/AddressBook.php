<?php

namespace Phpfox\Payments;


class AddressBook
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * AddressBook constructor.
     *
     * @param null $data
     */
    public function __construct($data = null)
    {
        if (is_array($data)) {
            $this->initialize($data);
        }
    }

    public function initialize($data)
    {
        foreach ($data as $name => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($name))) {
                $this->{$method}($value);
            } else {
                $this->data[$name] = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    public function __get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param mixed $value
     */
    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param mixed $value
     */
    public function setName($value)
    {
        $this->__set('name', $value);
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->__get('first_name');
    }

    /**
     * @param mixed $value
     */
    public function setFirstName($value)
    {
        $this->__set('first_name', $value);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->__get('last_name');
    }

    /**
     * @param mixed $value
     */
    public function setLastName($value)
    {
        $this->__set('last_name', $value);
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->__get('company');
    }

    /**
     * @param mixed $value
     */
    public function setCompany($value)
    {
        $this->__set('company', $value);
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->__get('address1');
    }

    /**
     * @param mixed $value
     */
    public function setAddress1($value)
    {
        $this->__set('address1', $value);
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->__get('address2');
    }

    /**
     * @param mixed $value
     */
    public function setAddress2($value)
    {
        $this->__set('address2', $value);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->__get('city');
    }

    /**
     * @param mixed $value
     */
    public function setCity($value)
    {
        $this->__set('city', $value);
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->__get('postcode');
    }

    /**
     * @param mixed $value
     */
    public function setPostcode($value)
    {
        $this->__set('postcode', $value);
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->__get('state');
    }

    /**
     * @param mixed $value
     */
    public function setState($value)
    {
        $this->__set('state', $value);
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->__get('country');
    }

    /**
     * @param mixed $value
     */
    public function setCountry($value)
    {
        $this->__set('country', $value);
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->__get('phone');
    }

    /**
     * @param mixed $value
     */
    public function setPhone($value)
    {
        $this->__set('phone', $value);
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->__get('fax');
    }

    /**
     * @param mixed $value
     */
    public function setFax($value)
    {
        $this->__set('fax', $value);
    }
}