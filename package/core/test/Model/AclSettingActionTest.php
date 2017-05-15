<?php

namespace Neutron\Core\Model;

class AclSettingActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingAction([
            'action_id'  => 1,
            'package_id' => 'core',
            'group_id'   => 'core',
            'name'       => 'can_clear_site_cache',
            'ordering' => 0,
            'is_active'  => 1,
        ]);

        $this->assertSame('acl_setting_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('can_clear_site_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new AclSettingAction();

        // set data
        $obj->setActionId(1);
        $obj->setPackageId('core');
        $obj->setGroupId('core');
        $obj->setName('can_clear_site_cache');
        $obj->setOrdering(0);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('acl_setting_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('can_clear_site_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new AclSettingAction([
            'action_id'  => 1,
            'package_id' => 'core',
            'group_id'   => 'core',
            'name'       => 'can_clear_site_cache',
            'ordering' => 0,
            'is_active'  => 1,
        ]);

        $obj->save();

        /** @var AclSettingAction $obj */
        $obj = _model('acl_setting_action')
            ->select()->where('action_id=?', 1)->first();

        $this->assertSame('acl_setting_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('can_clear_site_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('acl_setting_action')
            ->delete()->where('action_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_setting_action')
            ->delete()->where('action_id=?', 1)->execute();
    }
}