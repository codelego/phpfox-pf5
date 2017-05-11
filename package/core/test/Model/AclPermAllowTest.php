<?php
namespace Neutron\Core\Model;

class AclPermAllowTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclPermAllow(array (  'id' => 1,  'resource_type' => 'site',  'resource_id' => 1,  'role_id' => 'admin',  'action_id' => 'access',  'value_id' => 1,));

        $this->assertSame('acl_perm_allow', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('site', $obj->getResourceType());
        $this->assertSame(1, $obj->getResourceId());
        $this->assertSame('admin', $obj->getRoleId());
        $this->assertSame('access', $obj->getActionId());
        $this->assertSame(1, $obj->getValueId());    }

    public function testParameters()
    {
        $obj = new AclPermAllow();

        // set data
        $obj->setId(1);
        $obj->setResourceType('site');
        $obj->setResourceId(1);
        $obj->setRoleId('admin');
        $obj->setActionId('access');
        $obj->setValueId(1);
        // assert same data
        $this->assertSame('acl_perm_allow', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('site', $obj->getResourceType());
        $this->assertSame(1, $obj->getResourceId());
        $this->assertSame('admin', $obj->getRoleId());
        $this->assertSame('access', $obj->getActionId());
        $this->assertSame(1, $obj->getValueId());    }

    public function testSave()
    {
        $obj = new AclPermAllow(array (  'id' => 1,  'resource_type' => 'site',  'resource_id' => 1,  'role_id' => 'admin',  'action_id' => 'access',  'value_id' => 1,));

        $obj->save();

        /** @var AclPermAllow $obj */
        $obj = _model('acl_perm_allow')
            ->select()->where('id=?',1)->first();

        $this->assertSame('acl_perm_allow', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('site', $obj->getResourceType());
        $this->assertSame(1, $obj->getResourceId());
        $this->assertSame('admin', $obj->getRoleId());
        $this->assertSame('access', $obj->getActionId());
        $this->assertSame(1, $obj->getValueId());    }

    public static function setUpBeforeClass()
    {
        _model('acl_perm_allow')
            ->delete()->where('id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_perm_allow')
            ->delete()->where('id=?',1)->execute();
    }
}