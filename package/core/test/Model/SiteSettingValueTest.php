<?php
namespace Neutron\Core\Model;

class SiteSettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SiteSettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'group_id' => 'core_seo',  'name' => 'title_separator',  'value_actual' => '"&#187;"',  'sort_order' => 99,  'is_active' => 1,));

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_seo', $obj->getGroupId());
        $this->assertSame('title_separator', $obj->getName());
        $this->assertSame('"&#187;"', $obj->getValueActual());
        $this->assertSame(99, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new SiteSettingValue();

        // set data
        $obj->setValueId(1);
        $obj->setPackageId('core');
        $obj->setGroupId('core_seo');
        $obj->setName('title_separator');
        $obj->setValueActual('"&#187;"');
        $obj->setSortOrder(99);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_seo', $obj->getGroupId());
        $this->assertSame('title_separator', $obj->getName());
        $this->assertSame('"&#187;"', $obj->getValueActual());
        $this->assertSame(99, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new SiteSettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'group_id' => 'core_seo',  'name' => 'title_separator',  'value_actual' => '"&#187;"',  'sort_order' => 99,  'is_active' => 1,));

        $obj->save();

        /** @var SiteSettingValue $obj */
        $obj = _model('site_setting_value')
            ->select()->where('value_id=?',1)->first();

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_seo', $obj->getGroupId());
        $this->assertSame('title_separator', $obj->getName());
        $this->assertSame('"&#187;"', $obj->getValueActual());
        $this->assertSame(99, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('site_setting_value')
            ->delete()->where('value_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('site_setting_value')
            ->delete()->where('value_id=?',1)->execute();
    }
}