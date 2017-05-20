<?php
namespace Neutron\Core\Model;

class AclActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclAction(array (  'action_id' => 1,  'action_type' => 'site',  'package_id' => 'core',  'group_id' => 'core',  'form_id' => 'core_admin',  'name' => 'clear_cache',  'ordering' => 0,  'is_active' => 1,));

        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('site', $obj->getActionType());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('clear_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new AclAction();

        // set data
        $obj->setActionId(1);
        $obj->setActionType('site');
        $obj->setPackageId('core');
        $obj->setGroupId('core');
        $obj->setFormId('core_admin');
        $obj->setName('clear_cache');
        $obj->setOrdering(0);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('site', $obj->getActionType());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('clear_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new AclAction(array (  'action_id' => 1,  'action_type' => 'site',  'package_id' => 'core',  'group_id' => 'core',  'form_id' => 'core_admin',  'name' => 'clear_cache',  'ordering' => 0,  'is_active' => 1,));

        $obj->save();

        /** @var AclAction $obj */
        $obj = _model('acl_action')
            ->select()->where('action_id=?',1)->first();

        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(1, $obj->getActionId());
        $this->assertSame('site', $obj->getActionType());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('clear_cache', $obj->getName());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('acl_action')
            ->delete()->where('action_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_action')
            ->delete()->where('action_id=?',1)->execute();
    }
}