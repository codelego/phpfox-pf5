<?php
namespace Phpfox\Authorization;


class AuthorizationManagerTest extends \PHPUnit_Framework_TestCase
{
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
}
