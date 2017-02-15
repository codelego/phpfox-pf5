<?php

namespace Neutron\User\Service;


use Neutron\User\Model\User;

class UserBrowseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return mixed
     */
    public function testFindUser()
    {
        $user = \Phpfox::db()
            ->select('*')
            ->from(':user')
            ->setPrototype(User::class)
            ->first();

        $this->assertTrue($user instanceof User);

        return $user->getId();
    }

    /**
     * @param $userId
     * @return mixed|User
     * @depends testFindUser
     */
    public function testFindByUserIdValid($userId)
    {
        $obj = new UserBrowse();
        $user = $obj->findUserById($userId);
        $this->assertNotNull($user);
        $this->assertTrue($user instanceof User);

        return $user;
    }

    public function testFindByIdNull()
    {
        $mn = new UserBrowse();

        $this->assertNull($mn->findUserById(null));
    }
}
