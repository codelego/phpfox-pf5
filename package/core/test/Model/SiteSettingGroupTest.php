<?php
namespace Neutron\Core\Model;

class SiteSettingGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SiteSettingGroup(array (  'group_id' => 'blog',  'package_id' => 'blog',  'title' => 'Blog Settings',  'form_name' => 'Neutron\\Blog\\Form\\Admin\\Settings\\SiteSettings',  'description' => 'Blog Settings',  'sort_order' => 2,  'is_active' => 1,));

        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('blog', $obj->getGroupId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new SiteSettingGroup();

        // set data
        $obj->setGroupId('blog');
        $obj->setPackageId('blog');
        $obj->setTitle('Blog Settings');
        $obj->setFormName('Neutron\Blog\Form\Admin\Settings\SiteSettings');
        $obj->setDescription('Blog Settings');
        $obj->setSortOrder(2);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('blog', $obj->getGroupId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new SiteSettingGroup(array (  'group_id' => 'blog',  'package_id' => 'blog',  'title' => 'Blog Settings',  'form_name' => 'Neutron\\Blog\\Form\\Admin\\Settings\\SiteSettings',  'description' => 'Blog Settings',  'sort_order' => 2,  'is_active' => 1,));

        $obj->save();

        /** @var SiteSettingGroup $obj */
        $obj = _model('site_setting_group')
            ->select()->where('group_id=?','blog')->first();

        $this->assertSame('site_setting_group', $obj->getModelId());
        $this->assertSame('blog', $obj->getGroupId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('site_setting_group')
            ->delete()->where('group_id=?','blog')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('site_setting_group')
            ->delete()->where('group_id=?','blog')->execute();
    }
}