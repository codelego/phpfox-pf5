<?php
namespace Neutron\Core\Model;

class SettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'domain_id' => 'core',  'form_id' => 'core_captcha',  'name' => 'default_captcha_id',  'value_actual' => '"3"',  'ordering' => 1,  'is_active' => 1,));

        $this->assertSame('setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_captcha', $obj->getFormId());
        $this->assertSame('default_captcha_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new SettingValue();

        // set data
        $obj->setValueId(1);
        $obj->setPackageId('core');
        $obj->setDomainId('core');
        $obj->setFormId('core_captcha');
        $obj->setName('default_captcha_id');
        $obj->setValueActual('"3"');
        $obj->setOrdering(1);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_captcha', $obj->getFormId());
        $this->assertSame('default_captcha_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new SettingValue(array (  'value_id' => 1,  'package_id' => 'core',  'domain_id' => 'core',  'form_id' => 'core_captcha',  'name' => 'default_captcha_id',  'value_actual' => '"3"',  'ordering' => 1,  'is_active' => 1,));

        $obj->save();

        /** @var SettingValue $obj */
        $obj = _model('setting_value')
            ->select()->where('value_id=?',1)->first();

        $this->assertSame('setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getValueId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core', $obj->getDomainId());
        $this->assertSame('core_captcha', $obj->getFormId());
        $this->assertSame('default_captcha_id', $obj->getName());
        $this->assertSame('"3"', $obj->getValueActual());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('setting_value')
            ->delete()->where('value_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('setting_value')
            ->delete()->where('value_id=?',1)->execute();
    }
}