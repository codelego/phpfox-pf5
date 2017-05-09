<?php

namespace Neutron\Core\Model;

class AclSettingActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingAction();

        $this->assertSame('acl_setting_action', $obj->getModelId());
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
        $obj = new AclSettingAction();

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
        $this->assertSame('acl_setting_action', $obj->getModelId());
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
        $obj = new AclSettingAction();

        $obj->save();

        /** @var AclSettingAction $obj */
        $obj = _model('acl_setting_action')
            ->select()->where('action_id=?', '')->first();

        $this->assertSame('acl_setting_action', $obj->getModelId());
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
        _model('acl_setting_action')
            ->delete()->where('action_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_setting_action')
            ->delete()->where('action_id=?', '')->execute();
    }
}