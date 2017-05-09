<?php

namespace Neutron\Core\Model;

class AclSettingGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingGroup();

        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getSortOrder());
        $this->assertSame('', $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new AclSettingGroup();

        // set data
        $obj->setId('');
        $obj->setPackageId('');
        $obj->setTitle('');
        $obj->setFormName('');
        $obj->setDescription('');
        $obj->setSortOrder('');
        $obj->setActive('');

        // assert same data
        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getSortOrder());
        $this->assertSame('', $obj->isActive());
    }

    public function testSave()
    {
        $obj = new AclSettingGroup();

        $obj->save();

        /** @var AclSettingGroup $obj */
        $obj = _model('acl_setting_group')
            ->select()->where('group_id=?', '')->first();

        $this->assertSame('acl_setting_group', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getSortOrder());
        $this->assertSame('', $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('acl_setting_group')
            ->delete()->where('group_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_setting_group')
            ->delete()->where('group_id=?', '')->execute();
    }
}