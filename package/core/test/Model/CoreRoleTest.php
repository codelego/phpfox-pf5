<?php

namespace Neutron\Core\Model;

class CoreRoleTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $obj = new CoreRole([
            'role_id'       => 999,
            'is_super'      => 1,
            'is_admin'      => 1,
            'is_banned'     => 0,
            'is_registered' => 1,
            'is_guest'      => 0,
            'is_staff'      => 1,
            'is_special'    => 0,
            'inherit_id'    => 7,
            'is_moderator'  => 1,
            'title'         => '[example role name]',
        ]);

        $this->assertEquals('core_role', $obj->getModelId());
        $this->assertEquals(999, $obj->getId());
        $this->assertEquals(999, $obj->getRoleId());

        $this->assertEquals(1, $obj->isSuper());
        $this->assertEquals(1, $obj->isAdmin());
        $this->assertEquals(0, $obj->isBanned());
        $this->assertEquals(1, $obj->isRegistered());
        $this->assertEquals(1, $obj->isStaff());
        $this->assertEquals(1, $obj->isModerator());
        $this->assertEquals(0, $obj->isGuest());
        $this->assertEquals(0, $obj->isSpecial());
        $this->assertEquals(7, $obj->getInheritId());
        $this->assertEquals('[example role name]', $obj->getTitle());
        $this->assertEquals('[example role name]', $obj->getName());
        $this->assertSame(0, $obj->getUserCount());
    }
}
