<?php

namespace Neutron\Friend\Model;


use Phpfox\Db\DbModel;

class FriendList extends DbModel
{
    public function getModelId()
    {
        return 'friend_list';
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', (int)$value);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->__get('list_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('list_id', (int)$value);
    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return (int)$this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value)
    {
        $this->__set('type_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }
}