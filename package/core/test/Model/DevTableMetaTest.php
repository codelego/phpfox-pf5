<?php

namespace Neutron\Core\Model;

class DevTableMetaTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevTableMeta(array (  'table_name' => 'acl_perm_allow',  'package_id' => 'core',  'action_id' => 'default',));

        $this->assertSame('dev_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public function testParameters()
    {
        $obj = new DevTableMeta();

        // set data
        $obj->setId('acl_perm_allow');
        $obj->setPackageId('core');
        $obj->setActionId('default');

        // assert same data
        $this->assertSame('dev_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public function testSave()
    {
        $obj = new DevTableMeta(array (  'table_name' => 'acl_perm_allow',  'package_id' => 'core',  'action_id' => 'default',));

        $obj->save();

        /** @var DevTableMeta $obj */
        $obj = _model('dev_table_meta')
            ->select()->where('table_name=?','acl_perm_allow')->first();

        $this->assertSame('dev_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public static function setUpBeforeClass()
    {
        _model('dev_table_meta')
            ->delete()->where('table_name=?','acl_perm_allow')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_table_meta')
            ->delete()->where('table_name=?','acl_perm_allow')->execute();
    }
}