<?php
namespace Neutron\Core\Model;

class SettingFormTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SettingForm(array (  'form_id' => 'blog',  'package_id' => 'blog',  'title' => 'Blog Settings',  'form_name' => 'Neutron\\Blog\\Form\\Admin\\Settings\\SiteSettings',  'description' => 'Blog Settings',  'ordering' => 2,  'is_active' => 1,));

        $this->assertSame('setting_form', $obj->getModelId());
        $this->assertSame('blog', $obj->getFormId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new SettingForm();

        // set data
        $obj->setFormId('blog');
        $obj->setPackageId('blog');
        $obj->setTitle('Blog Settings');
        $obj->setFormName('Neutron\Blog\Form\Admin\Settings\SiteSettings');
        $obj->setDescription('Blog Settings');
        $obj->setOrdering(2);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('setting_form', $obj->getModelId());
        $this->assertSame('blog', $obj->getFormId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new SettingForm(array (  'form_id' => 'blog',  'package_id' => 'blog',  'title' => 'Blog Settings',  'form_name' => 'Neutron\\Blog\\Form\\Admin\\Settings\\SiteSettings',  'description' => 'Blog Settings',  'ordering' => 2,  'is_active' => 1,));

        $obj->save();

        /** @var SettingForm $obj */
        $obj = _model('setting_form')
            ->select()->where('form_id=?','blog')->first();

        $this->assertSame('setting_form', $obj->getModelId());
        $this->assertSame('blog', $obj->getFormId());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog Settings', $obj->getTitle());
        $this->assertSame('Neutron\Blog\Form\Admin\Settings\SiteSettings', $obj->getFormName());
        $this->assertSame('Blog Settings', $obj->getDescription());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('setting_form')
            ->delete()->where('form_id=?','blog')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('setting_form')
            ->delete()->where('form_id=?','blog')->execute();
    }
}