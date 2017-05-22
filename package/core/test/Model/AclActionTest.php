<?php
namespace Neutron\Core\Model;

class AclActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclAction(array (  'action_id' => 21,  'package_id' => 'core',  'domain_id' => 'core',  'form_id' => 'core_general',  'name' => 'storage_limit',  'ordering' => 1,  'is_active' => 1,));

        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(21, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_general', $obj->getFormId());
        $this->assertSame('storage_limit', $obj->getName());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new AclAction();

        // set data
        $obj->setActionId(21);
        $obj->setPackageId('core');
        $obj->setDomainId('core');
        $obj->setFormId('core_general');
        $obj->setName('storage_limit');
        $obj->setOrdering(1);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(21, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_general', $obj->getFormId());
        $this->assertSame('storage_limit', $obj->getName());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new AclAction(array (  'action_id' => 21,  'package_id' => 'core',  'domain_id' => 'core',  'form_id' => 'core_general',  'name' => 'storage_limit',  'ordering' => 1,  'is_active' => 1,));

        $obj->save();

        /** @var AclAction $obj */
        $obj = _model('acl_action')
            ->select()->where('action_id=?',21)->first();

        $this->assertSame('acl_action', $obj->getModelId());
        $this->assertSame(21, $obj->getActionId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_general', $obj->getFormId());
        $this->assertSame('storage_limit', $obj->getName());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('acl_action')
            ->delete()->where('action_id=?',21)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_action')
            ->delete()->where('action_id=?',21)->execute();
    }
}