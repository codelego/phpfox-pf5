<?php
namespace Neutron\Core\Model;

class SiteSettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SiteSettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'group_id' => 'captcha',  'form_id' => 'captcha',  'name' => 'adapter_id',  'value_actual' => '"3"',  'sort_order' => 1,  'is_active' => 1,));

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('captcha', $obj->getGroupId());
        $this->assertSame('captcha', $obj->getFormId());
        $this->assertSame('adapter_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new SiteSettingValue();

        // set data
        $obj->setValueId(1);
        $obj->setPackageId('core');
        $obj->setGroupId('captcha');
        $obj->setFormId('captcha');
        $obj->setName('adapter_id');
        $obj->setValueActual('"3"');
        $obj->setSortOrder(1);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('captcha', $obj->getGroupId());
        $this->assertSame('captcha', $obj->getFormId());
        $this->assertSame('adapter_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new SiteSettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'group_id' => 'captcha',  'form_id' => 'captcha',  'name' => 'adapter_id',  'value_actual' => '"3"',  'sort_order' => 1,  'is_active' => 1,));

        $obj->save();

        /** @var SiteSettingValue $obj */
        $obj = _model('site_setting_value')
            ->select()->where('value_id=?',1)->first();

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('captcha', $obj->getGroupId());
        $this->assertSame('captcha', $obj->getFormId());
        $this->assertSame('adapter_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getSortOrder());
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