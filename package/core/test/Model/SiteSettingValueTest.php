<?php

namespace Neutron\Core\Model;

class SiteSettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SiteSettingValue([
            'value_id'        => 1,
            'package_id'      => 'core',
            'group_id'        => 'core_site',
            'name'            => 'title_delim',
            'phrase_var_name' => 'Title Delimiter',
            'value_actual'    => '{"val":"Social Network"}',
            'priority'        => 0,
            'is_active'       => 1,
        ]);

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_site', $obj->getGroupId());
        $this->assertSame('title_delim', $obj->getName());
        $this->assertSame('Title Delimiter', $obj->getPhraseVarName());
        $this->assertSame('{"val":"Social Network"}', $obj->getValueActual());
        $this->assertSame(0, $obj->getPriority());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new SiteSettingValue();

        // set data
        $obj->setId(1);
        $obj->setPackageId('core');
        $obj->setGroupId('core_site');
        $obj->setName('title_delim');
        $obj->setPhraseVarName('Title Delimiter');
        $obj->setValueActual('{"val":"Social Network"}');
        $obj->setPriority(0);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_site', $obj->getGroupId());
        $this->assertSame('title_delim', $obj->getName());
        $this->assertSame('Title Delimiter', $obj->getPhraseVarName());
        $this->assertSame('{"val":"Social Network"}', $obj->getValueActual());
        $this->assertSame(0, $obj->getPriority());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new SiteSettingValue([
            'value_id'        => 1,
            'package_id'      => 'core',
            'group_id'        => 'core_site',
            'name'            => 'title_delim',
            'phrase_var_name' => 'Title Delimiter',
            'value_actual'    => '{"val":"Social Network"}',
            'priority'        => 0,
            'is_active'       => 1,
        ]);

        $obj->save();

        /** @var SiteSettingValue $obj */
        $obj = _model('site_setting_value')
            ->select()->where('value_id=?', 1)->first();

        $this->assertSame('site_setting_value', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('core_site', $obj->getGroupId());
        $this->assertSame('title_delim', $obj->getName());
        $this->assertSame('Title Delimiter', $obj->getPhraseVarName());
        $this->assertSame('{"val":"Social Network"}', $obj->getValueActual());
        $this->assertSame(0, $obj->getPriority());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('site_setting_value')
            ->delete()->where('value_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('site_setting_value')
            ->delete()->where('value_id=?', 1)->execute();
    }
}