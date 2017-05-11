<?php

namespace Neutron\Core\Model;

class RadMetaTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new RadMeta(array (  'meta_id' => 'Neutron\\Core\\Form\\Admin\\AclRole\\AddAclRole',  'action_id' => 'default',  'type_id' => 'form',  'package_id' => 'core',  'text_domain' => 'admin.core',));

        $this->assertSame('rad_meta', $obj->getModelId());
        $this->assertSame('Neutron\Core\Form\Admin\AclRole\AddAclRole', $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('form', $obj->getTypeId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('admin.core', $obj->getTextDomain());
    }

    public function testParameters()
    {
        $obj = new RadMeta();

        // set data
        $obj->setId('Neutron\Core\Form\Admin\AclRole\AddAclRole');
        $obj->setActionId('default');
        $obj->setTypeId('form');
        $obj->setPackageId('core');
        $obj->setTextDomain('admin.core');

        // assert same data
        $this->assertSame('rad_meta', $obj->getModelId());
        $this->assertSame('Neutron\Core\Form\Admin\AclRole\AddAclRole', $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('form', $obj->getTypeId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('admin.core', $obj->getTextDomain());
    }

    public function testSave()
    {
        $obj = new RadMeta(array (  'meta_id' => 'Neutron\\Core\\Form\\Admin\\AclRole\\AddAclRole',  'action_id' => 'default',  'type_id' => 'form',  'package_id' => 'core',  'text_domain' => 'admin.core',));

        $obj->save();

        /** @var RadMeta $obj */
        $obj = _model('rad_meta')
            ->select()->where('meta_id=?','Neutron\Core\Form\Admin\AclRole\AddAclRole')->first();

        $this->assertSame('rad_meta', $obj->getModelId());
        $this->assertSame('Neutron\Core\Form\Admin\AclRole\AddAclRole', $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('form', $obj->getTypeId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('admin.core', $obj->getTextDomain());
    }

    public static function setUpBeforeClass()
    {
        _model('rad_meta')
            ->delete()->where('meta_id=?','Neutron\Core\Form\Admin\AclRole\AddAclRole')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('rad_meta')
            ->delete()->where('meta_id=?','Neutron\Core\Form\Admin\AclRole\AddAclRole')->execute();
    }
}