<?php

namespace Phpfox\Authentication;


class MockExampleUser
{
    protected $user_id = 1000;

    public function __construct($id)
    {
        $this->user_id = $id;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getModelId()
    {
        return 'example_user';
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}