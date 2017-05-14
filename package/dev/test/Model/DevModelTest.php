<?php
namespace Neutron\Dev\Model;

class DevModelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevModel(array (  'id' => 449,  'package_id' => 'core',  'table_name' => 'acl_perm_allow',  'action_type' => 'model_class',  'action_id' => 'create',  'text_domain' => NULL,  'form_title' => NULL,  'form_info' => NULL,  'data_submit' => NULL,  'cancel_url' => NULL,  'action_url' => NULL,));

        $this->assertSame('dev_model', $obj->getModelId());
        $this->assertSame(449, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('model_class', $obj->getActionType());
        $this->assertSame('create', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());    }

    public function testParameters()
    {
        $obj = new DevModel();

        // set data
        $obj->setId(449);
        $obj->setPackageId('core');
        $obj->setTableName('acl_perm_allow');
        $obj->setActionType('model_class');
        $obj->setActionId('create');
        $obj->setTextDomain('');
        $obj->setFormTitle('');
        $obj->setFormInfo('');
        $obj->setDataSubmit('');
        $obj->setCancelUrl('');
        $obj->setActionUrl('');
        // assert same data
        $this->assertSame('dev_model', $obj->getModelId());
        $this->assertSame(449, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('model_class', $obj->getActionType());
        $this->assertSame('create', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());    }

    public function testSave()
    {
        $obj = new DevModel(array (  'id' => 449,  'package_id' => 'core',  'table_name' => 'acl_perm_allow',  'action_type' => 'model_class',  'action_id' => 'create',  'text_domain' => NULL,  'form_title' => NULL,  'form_info' => NULL,  'data_submit' => NULL,  'cancel_url' => NULL,  'action_url' => NULL,));

        $obj->save();

        /** @var DevModel $obj */
        $obj = _model('dev_model')
            ->select()->where('id=?',449)->first();

        $this->assertSame('dev_model', $obj->getModelId());
        $this->assertSame(449, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('model_class', $obj->getActionType());
        $this->assertSame('create', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());    }

    public static function setUpBeforeClass()
    {
        _model('dev_model')
            ->delete()->where('id=?',449)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_model')
            ->delete()->where('id=?',449)->execute();
    }
}