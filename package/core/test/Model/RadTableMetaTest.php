<?php

namespace Neutron\Core\Model;

class RadTableMetaTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new RadTableMeta(array (  'table_name' => 'acl_perm_allow',  'package_id' => 'core',  'action_id' => 'default',));

        $this->assertSame('rad_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public function testParameters()
    {
        $obj = new RadTableMeta();

        // set data
        $obj->setId('acl_perm_allow');
        $obj->setPackageId('core');
        $obj->setActionId('default');

        // assert same data
        $this->assertSame('rad_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public function testSave()
    {
        $obj = new RadTableMeta(array (  'table_name' => 'acl_perm_allow',  'package_id' => 'core',  'action_id' => 'default',));

        $obj->save();

        /** @var RadTableMeta $obj */
        $obj = _model('rad_table_meta')
            ->select()->where('table_name=?','acl_perm_allow')->first();

        $this->assertSame('rad_table_meta', $obj->getModelId());
        $this->assertSame('acl_perm_allow', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('default', $obj->getActionId());
    }

    public static function setUpBeforeClass()
    {
        _model('rad_table_meta')
            ->delete()->where('table_name=?','acl_perm_allow')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('rad_table_meta')
            ->delete()->where('table_name=?','acl_perm_allow')->execute();
    }
}