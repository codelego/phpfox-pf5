<?php

namespace Neutron\Dev\Model;

class DevFormTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevForm(['id'          => 9,
                            'package_id'  => 'core',
                            'table_name'  => 'acl_perm_allow',
                            'action_type' => 'admin_add',
                            'action_id'   => 'delete',
                            'text_domain' => null,
                            'form_title'  => null,
                            'form_info'   => null,
                            'data_submit' => null,
                            'cancel_url'  => null,
                            'action_url'  => null,
        ]);

        $this->assertSame('dev_form', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());
    }

    public function testParameters()
    {
        $obj = new DevForm();

        // set data
        $obj->setId(9);
        $obj->setPackageId('core');
        $obj->setTableName('acl_perm_allow');
        $obj->setActionType('admin_add');
        $obj->setActionId('delete');
        $obj->setTextDomain('');
        $obj->setFormTitle('');
        $obj->setFormInfo('');
        $obj->setDataSubmit('');
        $obj->setCancelUrl('');
        $obj->setActionUrl('');
        // assert same data
        $this->assertSame('dev_form', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());
    }

    public function testSave()
    {
        $obj = new DevForm(['id'          => 9,
                            'package_id'  => 'core',
                            'table_name'  => 'acl_perm_allow',
                            'action_type' => 'admin_add',
                            'action_id'   => 'delete',
                            'text_domain' => null,
                            'form_title'  => null,
                            'form_info'   => null,
                            'data_submit' => null,
                            'cancel_url'  => null,
                            'action_url'  => null,
        ]);

        $obj->save();

        /** @var DevForm $obj */
        $obj = \Phpfox::model('dev_form')
            ->select()->where('id=?', 9)->first();

        $this->assertSame('dev_form', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getActionType());
        $this->assertSame('delete', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('', $obj->getFormTitle());
        $this->assertSame('', $obj->getFormInfo());
        $this->assertSame('', $obj->getDataSubmit());
        $this->assertSame('', $obj->getCancelUrl());
        $this->assertSame('', $obj->getActionUrl());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('dev_form')
            ->delete()->where('id=?', 9)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('dev_form')
            ->delete()->where('id=?', 9)->execute();
    }
}