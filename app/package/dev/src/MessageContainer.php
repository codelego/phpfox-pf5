<?php

namespace Neutron\Dev;


class MessageContainer
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $domain = '';

    /**
     * MessageContainer constructor.
     *
     * @param string $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param string $domain
     * @param string $name
     * @param string $value
     */
    public function add($domain, $name, $value = null)
    {
        if (!$domain) {
            $domain = $this->domain;
        }
        $this->data[$domain][$name] = $value ? $value : $name;
    }

    public function all()
    {
        return $this->data;
    }
}