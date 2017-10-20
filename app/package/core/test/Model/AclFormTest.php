<?php

namespace Neutron\Core\Model;

class AclFormTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclForm(['form_id'     => 'core_admin',
                            'package_id'  => 'core',
                            'title'       => 'Admin Settings',
                            'form_name'   => 'Neutron\\Core\\Form\\Admin\\Settings\\EditAdminPermissions',
                            'description' => '',
                            'ordering'    => 1,
                            'is_active'   => 1,
        ]);

        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Admin Settings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\Admin\Settings\EditAdminPermissions', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new AclForm();

        // set data
        $obj->setFormId('core_admin');
        $obj->setPackageId('core');
        $obj->setTitle('Admin Settings');
        $obj->setFormName('Neutron\Core\Form\Admin\Settings\EditAdminPermissions');
        $obj->setDescription('');
        $obj->setOrdering(1);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Admin Settings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\Admin\Settings\EditAdminPermissions', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new AclForm(['form_id'     => 'core_admin',
                            'package_id'  => 'core',
                            'title'       => 'Admin Settings',
                            'form_name'   => 'Neutron\\Core\\Form\\Admin\\Settings\\EditAdminPermissions',
                            'description' => '',
                            'ordering'    => 1,
                            'is_active'   => 1,
        ]);

        $obj->save();

        /** @var AclForm $obj */
        $obj = \Phpfox::model('acl_form')
            ->select()->where('form_id=?', 'core_admin')->first();

        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('core_admin', $obj->getFormId());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Admin Settings', $obj->getTitle());
        $this->assertSame('Neutron\Core\Form\Admin\Settings\EditAdminPermissions', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('acl_form')
            ->delete()->where('form_id=?', 'core_admin')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('acl_form')
            ->delete()->where('form_id=?', 'core_admin')->execute();
    }
}