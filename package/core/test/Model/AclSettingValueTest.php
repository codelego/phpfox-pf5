<?php

namespace Neutron\Core\Model;

class AclSettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingValue();

        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getGroupId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getPhraseVarName());
        $this->assertSame('', $obj->getValueActual());
        $this->assertSame('', $obj->getPriority());
        $this->assertSame('', $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new AclSettingValue();

        // set data
        $obj->setId('');
        $obj->setPackageId('');
        $obj->setGroupId('');
        $obj->setName('');
        $obj->setPhraseVarName('');
        $obj->setValueActual('');
        $obj->setPriority('');
        $obj->setActive('');

        // assert same data
        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getGroupId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getPhraseVarName());
        $this->assertSame('', $obj->getValueActual());
        $this->assertSame('', $obj->getPriority());
        $this->assertSame('', $obj->isActive());
    }

    public function testSave()
    {
        $obj = new AclSettingValue();

        $obj->save();

        /** @var AclSettingValue $obj */
        $obj = _with('acl_setting_value')
            ->select()->where('value_id=?', '')->first();

        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getGroupId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getPhraseVarName());
        $this->assertSame('', $obj->getValueActual());
        $this->assertSame('', $obj->getPriority());
        $this->assertSame('', $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _with('acl_setting_value')
            ->delete()->where('value_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('acl_setting_value')
            ->delete()->where('value_id=?', '')->execute();
    }
}