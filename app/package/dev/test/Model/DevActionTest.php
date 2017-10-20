<?php

namespace Neutron\Dev\Model;

class DevActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevAction(['meta_id'      => 9,
                              'package_id'   => 'core',
                              'table_name'   => 'acl_perm_allow',
                              'action_type'  => 'admin_add',
                              'action_id'    => 'delete',
                              'text_domain'  => null,
                              'form_title'   => null,
                              'form_info'    => null,
                              'data_submit'  => null,
                              'cancel_url'   => null,
                              'action_url'   => null,
                              'title_domain' => null,
                              'info_domain'  => null,
                              'submit_label' => null,
                              'form_enctype' => '',
                              'form_method'  => 'post',
        ]);

        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
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
        $this->assertSame('', $obj->getTitleDomain());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getSubmitLabel());
        $this->assertSame('', $obj->getFormEnctype());
        $this->assertSame('post', $obj->getFormMethod());
    }

    public function testParameters()
    {
        $obj = new DevAction();

        // set data
        $obj->setMetaId(9);
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
        $obj->setTitleDomain('');
        $obj->setInfoDomain('');
        $obj->setSubmitLabel('');
        $obj->setFormEnctype('');
        $obj->setFormMethod('post');
        // assert same data
        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
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
        $this->assertSame('', $obj->getTitleDomain());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getSubmitLabel());
        $this->assertSame('', $obj->getFormEnctype());
        $this->assertSame('post', $obj->getFormMethod());
    }

    public function testSave()
    {
        $obj = new DevAction(['meta_id'      => 9,
                              'package_id'   => 'core',
                              'table_name'   => 'acl_perm_allow',
                              'action_type'  => 'admin_add',
                              'action_id'    => 'delete',
                              'text_domain'  => null,
                              'form_title'   => null,
                              'form_info'    => null,
                              'data_submit'  => null,
                              'cancel_url'   => null,
                              'action_url'   => null,
                              'title_domain' => null,
                              'info_domain'  => null,
                              'submit_label' => null,
                              'form_enctype' => '',
                              'form_method'  => 'post',
        ]);

        $obj->save();

        /** @var DevAction $obj */
        $obj = \Phpfox::model('dev_action')
            ->select()->where('meta_id=?', 9)->first();

        $this->assertSame('dev_action', $obj->getModelId());
        $this->assertSame(9, $obj->getMetaId());
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
        $this->assertSame('', $obj->getTitleDomain());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getSubmitLabel());
        $this->assertSame('', $obj->getFormEnctype());
        $this->assertSame('post', $obj->getFormMethod());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('dev_action')
            ->delete()->where('meta_id=?', 9)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('dev_action')
            ->delete()->where('meta_id=?', 9)->execute();
    }
}