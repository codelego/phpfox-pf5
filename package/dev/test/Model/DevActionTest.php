<?php
namespace Neutron\Dev\Model;

class DevActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevAction(array (  'meta_id' => 9,  'package_id' => 'core',  'table_name' => 'acl_perm_allow',  'action_type' => 'admin_add',  'action_id' => 'delete',  'text_domain' => NULL,));

        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());    }

    public function testParameters()
    {
        $obj = new DevAction();

        // set data
        $obj->setMetaId(9);
        $obj->setPackageId('core');
        $obj->setTableName('acl_perm_allow');
        $obj->setActionType('admin_add');
        $obj->setActionId('delete');
        $obj->setTextDomain('');
        // assert same data
        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());    }

    public function testSave()
    {
        $obj = new DevAction(array (  'meta_id' => 9,  'package_id' => 'core',  'table_name' => 'acl_perm_allow',  'action_type' => 'admin_add',  'action_id' => 'delete',  'text_domain' => NULL,));

        $obj->save();

        /** @var DevAction $obj */
        $obj = _model('dev_action')
            ->select()->where('meta_id=?',9)->first();

        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());    }

    public static function setUpBeforeClass()
    {
        _model('dev_action')
            ->delete()->where('meta_id=?',9)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_action')
            ->delete()->where('meta_id=?',9)->execute();
    }
}