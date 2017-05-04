<?php

namespace Phpfox\Authorization;

use Neutron\User\Model\User;
use Phpfox\Event\Event;

class AuthorizationManagerTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        \Phpfox::get('manager')
            ->set('authorization.provider',
                new MockPermissionLoaderInterface());
    }

    public function testAdmin()
    {
        $mn = new AuthorizationManager();

        $mn->set(1, new PermissionData(1, [
            'is_super'      => 1,
            'is_admin'      => 1,
            'is_moderator'  => 1,
            'is_staff'      => 1,
            'is_banned'     => 0,
            'is_registered' => 1,
            'is_guest'      => 0,
        ]));

        $this->assertTrue($mn->pass(1, 'is_super'));
        $this->assertTrue($mn->pass(1, 'is_admin'));
        $this->assertTrue($mn->pass(1, 'is_moderator'));
        $this->assertTrue($mn->pass(1, 'is_staff'));
        $this->assertFalse($mn->pass(1, 'is_banned'));
        $this->assertTrue($mn->pass(1, 'is_registered'));
        $this->assertFalse($mn->pass(1, 'is_guest'));

        $mn->setRoleId(1);

        $this->assertTrue($mn->pass(null, 'is_super'));
        $this->assertTrue($mn->pass(null, 'is_admin'));
        $this->assertTrue($mn->pass(null, 'is_moderator'));
        $this->assertTrue($mn->pass(null, 'is_staff'));
        $this->assertFalse($mn->pass(null, 'is_banned'));
        $this->assertTrue($mn->pass(null, 'is_registered'));
        $this->assertFalse($mn->pass(null, 'is_guest'));
    }

    public function testLoader()
    {
        $mn = new AuthorizationManager();

        $data = $mn->load(1);

        $this->assertTrue($data instanceof PermissionData);

        $this->assertEquals(1, $data->get('is_super'));
        $this->assertEquals(1, $data->get('is_admin'));
        $this->assertEquals(1, $data->get('is_moderator'));
        $this->assertEquals(1, $data->get('is_staff'));
        $this->assertEquals(0, $data->get('is_banned'));
        $this->assertEquals(1, $data->get('is_registered'));
        $this->assertEquals(0, $data->get('is_guest'));
    }

    public function testEvent()
    {
        $mn = new AuthorizationManager();

        $user = new User(['role_id' => 100]);

        $mn->onLoginUser(new Event('onLoginUser', $user, []));

        $this->assertEquals(100, $user->getRoleId());
    }

    public function testEventEmpty()
    {
        $mn = new AuthorizationManager();

        $mn->onLoginUser(new Event('onLoginUser', null, []));

        $this->assertEquals(PHPFOX_GUEST_ID, $mn->getRoleId());
    }

    public function testRoleId()
    {
        $mn = new AuthorizationManager();

        $mn->setRoleId(100);

        $this->assertEquals(100, $mn->getRoleId());
    }

    public function testLoad()
    {
        $mn = new AuthorizationManager();
        $data = $mn->load(1);
        $this->assertEquals(true, $data instanceof PermissionData);
    }
}
