<?php

namespace Neutron\User\Service;


use Neutron\User\Model\AuthHistory;
use Neutron\User\Model\User;
use Phpfox\Event\Event;

class AuthHistoryManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testCleanup()
    {
        $obj = new AuthHistoryManager();

        $this->assertTrue($obj->cleanup()->isValid());
    }

    /**
     * @return string
     */
    public function testLog()
    {
        $mn = new AuthHistoryManager();

        /** @var AuthHistory $obj */
        $obj = $mn->log([
            'user_id'        => 12,
            'device_name'    => 'example device name',
            'remote_address' => '::1',
        ]);

        $this->assertTrue($obj instanceof AuthHistory);
        $this->assertSame(12, $obj->getUserId());
        $this->assertSame('example device name', $obj->getDeviceName());
        $this->assertSame('::1', $obj->getRemoteAddress());

        return $obj->getId();
    }

    public function testFindByIdByEmpty()
    {
        $mn = new AuthHistoryManager();
        $this->assertNull($mn->findById(0));
        $this->assertNull($mn->findById(null));
        $this->assertNull($mn->findById(''));
    }

    /**
     * @param $id
     *
     * @depends testLog
     */
    public function testFindById($id)
    {
        $mn = new AuthHistoryManager();
        $obj = $mn->findById($id);


        $this->assertTrue($obj instanceof AuthHistory);
        $this->assertSame($id, $obj->getId());
        $this->assertSame(12, $obj->getUserId());
        $this->assertSame('example device name', $obj->getDeviceName());
        $this->assertSame('::1', $obj->getRemoteAddress());
    }

    public function testOnUserLoginWithEmpty()
    {
        $mn = new AuthHistoryManager();

        $event = new Event('onUserLogin', null, null);

        $mn->onUserLogin($event);

        $this->assertFalse(false);
    }

    /**
     * @return User
     */
    public function testGetUser()
    {
        $user = _model('user')->select()->first();

        $this->assertTrue($user instanceof User);

        return $user;
    }

    /**
     * @param $user
     *
     * @depends testGetUser
     */
    public function testOnUserLoginUser($user)
    {
        $mn = new AuthHistoryManager();

        $event = new Event('onUserLogin', $user, null);

        $mn->onUserLogin($event);

        $this->assertFalse(false);
    }
}
