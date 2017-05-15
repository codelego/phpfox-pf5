<?php

namespace Neutron\Core\Model;

class AclSettingGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingGroup([
            'group_id'    => 'core',
            'package_id'  => 'core',
            'title'       => 'Core Settings',
            'form_name'   => '',
            'description' => '',
            'ordering'  => 1,
            'is_active'   => 1,
        ]);

        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Core Settings', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new AclSettingGroup();

        // set data
        $obj->setGroupId('core');
        $obj->setPackageId('core');
        $obj->setTitle('Core Settings');
        $obj->setFormName('');
        $obj->setDescription('');
        $obj->setOrdering(1);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Core Settings', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new AclSettingGroup([
            'group_id'    => 'core',
            'package_id'  => 'core',
            'title'       => 'Core Settings',
            'form_name'   => '',
            'description' => '',
            'ordering'  => 1,
            'is_active'   => 1,
        ]);

        $obj->save();

        /** @var AclSettingGroup $obj */
        $obj = _model('acl_setting_group')
            ->select()->where('group_id=?', 'core')->first();

        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('core', $obj->getGroupId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Core Settings', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('acl_setting_group')
            ->delete()->where('group_id=?', 'core')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_setting_group')
            ->delete()->where('group_id=?', 'core')->execute();
    }
}