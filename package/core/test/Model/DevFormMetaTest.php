<?php

namespace Neutron\Core\Model;

class DevFormMetaTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevFormMeta([
            'meta_id'     => 9,
            'table_name'  => 'acl_perm_allow',
            'package_id'  => null,
            'form_type'   => 'admin_add',
            'action_id'   => 'skip',
            'text_domain' => null,
        ]);

        $this->assertSame('dev_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public function testParameters()
    {
        $obj = new DevFormMeta();

        // set data
        $obj->setId(9);
        $obj->setTableName('acl_perm_allow');
        $obj->setPackageId('');
        $obj->setFormType('admin_add');
        $obj->setActionId('skip');
        $obj->setTextDomain('');

        // assert same data
        $this->assertSame('dev_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public function testSave()
    {
        $obj = new DevFormMeta([
            'meta_id'     => 9,
            'table_name'  => 'acl_perm_allow',
            'package_id'  => null,
            'form_type'   => 'admin_add',
            'action_id'   => 'skip',
            'text_domain' => null,
        ]);

        $obj->save();

        /** @var DevFormMeta $obj */
        $obj = _model('dev_form_meta')
            ->select()->where('meta_id=?', 9)->first();

        $this->assertSame('dev_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public static function setUpBeforeClass()
    {
        _model('dev_form_meta')
            ->delete()->where('meta_id=?', 9)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_form_meta')
            ->delete()->where('meta_id=?', 9)->execute();
    }
}