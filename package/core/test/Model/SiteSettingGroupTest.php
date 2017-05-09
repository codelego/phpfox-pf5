<?php

namespace Neutron\Core\Model;

class SiteSettingGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SiteSettingGroup([
            'group_id'    => 'core_mail',
            'package_id'  => 'core',
            'title'       => 'Mail Setttings',
            'form_name'   => 'Neutron\\Core\\Form\\AdminMailSettings',
            'description' => 'Mail Setttings',
            'sort_order'  => 4,
            'is_active'   => 1,
        ]);

        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('core_mail', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Mail Setttings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\AdminMailSettings', $obj->getFormName());
        $this->assertSame('Mail Setttings', $obj->getDescription());
        $this->assertSame(4, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new SiteSettingGroup();

        // set data
        $obj->setId('core_mail');
        $obj->setPackageId('core');
        $obj->setTitle('Mail Setttings');
        $obj->setFormName('Neutron\Core\Form\AdminMailSettings');
        $obj->setDescription('Mail Setttings');
        $obj->setSortOrder(4);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('core_mail', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Mail Setttings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\AdminMailSettings', $obj->getFormName());
        $this->assertSame('Mail Setttings', $obj->getDescription());
        $this->assertSame(4, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new SiteSettingGroup([
            'group_id'    => 'core_mail',
            'package_id'  => 'core',
            'title'       => 'Mail Setttings',
            'form_name'   => 'Neutron\\Core\\Form\\AdminMailSettings',
            'description' => 'Mail Setttings',
            'sort_order'  => 4,
            'is_active'   => 1,
        ]);

        $obj->save();

        /** @var SiteSettingGroup $obj */
        $obj = _model('site_setting_group')
            ->select()->where('group_id=?', 'core_mail')->first();

        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('core_mail', $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Mail Setttings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\AdminMailSettings', $obj->getFormName());
        $this->assertSame('Mail Setttings', $obj->getDescription());
        $this->assertSame(4, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('site_setting_group')
            ->delete()->where('group_id=?', 'core_mail')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('site_setting_group')
            ->delete()->where('group_id=?', 'core_mail')->execute();
    }
}