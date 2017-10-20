<?php

namespace Neutron\Dev\Model;

class DevModelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevModel(['id'          => 449,
                             'package_id'  => 'core',
                             'table_name'  => 'acl_perm_allow',
                             'action_type' => 'model_class',
                             'action_id'   => 'create',
                             'text_domain' => null,
                             'form_title'  => null,
                             'form_info'   => null,
                             'data_submit' => null,
                             'cancel_url'  => null,
                             'action_url'  => null,
        ]);

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
        $this->assertSame('', $obj->getActionUrl());
    }

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
        $this->assertSame('', $obj->getActionUrl());
    }

    public function testSave()
    {
        $obj = new DevModel(['id'          => 449,
                             'package_id'  => 'core',
                             'table_name'  => 'acl_perm_allow',
                             'action_type' => 'model_class',
                             'action_id'   => 'create',
                             'text_domain' => null,
                             'form_title'  => null,
                             'form_info'   => null,
                             'data_submit' => null,
                             'cancel_url'  => null,
                             'action_url'  => null,
        ]);

        $obj->save();

        /** @var DevModel $obj */
        $obj = \Phpfox::model('dev_model')
            ->select()->where('id=?', 449)->first();

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
        $this->assertSame('', $obj->getActionUrl());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('dev_model')
            ->delete()->where('id=?', 449)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('dev_model')
            ->delete()->where('id=?', 449)->execute();
    }
}