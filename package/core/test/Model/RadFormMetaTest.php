<?php

namespace Neutron\Core\Model;

class RadFormMetaTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new RadFormMeta(array (  'meta_id' => 9,  'table_name' => 'acl_perm_allow',  'form_type' => 'admin_add',  'action_id' => 'skip',  'text_domain' => NULL,));

        $this->assertSame('rad_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public function testParameters()
    {
        $obj = new RadFormMeta();

        // set data
        $obj->setId(9);
        $obj->setTableName('acl_perm_allow');
        $obj->setFormType('admin_add');
        $obj->setActionId('skip');
        $obj->setTextDomain('');

        // assert same data
        $this->assertSame('rad_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public function testSave()
    {
        $obj = new RadFormMeta(array (  'meta_id' => 9,  'table_name' => 'acl_perm_allow',  'form_type' => 'admin_add',  'action_id' => 'skip',  'text_domain' => NULL,));

        $obj->save();

        /** @var RadFormMeta $obj */
        $obj = _model('rad_form_meta')
            ->select()->where('meta_id=?',9)->first();

        $this->assertSame('rad_form_meta', $obj->getModelId());
        $this->assertSame(9, $obj->getId());
        $this->assertSame('acl_perm_allow', $obj->getTableName());
        $this->assertSame('admin_add', $obj->getFormType());
        $this->assertSame('skip', $obj->getActionId());
        $this->assertSame('', $obj->getTextDomain());
    }

    public static function setUpBeforeClass()
    {
        _model('rad_form_meta')
            ->delete()->where('meta_id=?',9)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('rad_form_meta')
            ->delete()->where('meta_id=?',9)->execute();
    }
}