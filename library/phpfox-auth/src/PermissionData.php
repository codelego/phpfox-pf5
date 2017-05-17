<?php

namespace Phpfox\Auth;


class PermissionData
{
    /**
     * @var int
     */
    private $roleId;

    /**
     * @var array
     */
    private $data = [];

    /**
     * PermissionDomain constructor.
     *
     * @param int   $roleId
     * @param array $data
     */
    public function __construct($roleId, array $data)
    {
        $this->roleId = $roleId;
        $this->data = $data;
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($name, $default = false)
    {
        return isset($this->data[$name]) ? $this->data[$name] : $default;
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }
}