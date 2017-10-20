<?php
namespace Neutron\Contact\Model;

class ContactDepartmentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ContactDepartment(array (  'department_id' => 1,  'name' => 'Support Departments',  'email' => 'info@younet.co',  'description' => '',  'is_active' => 1,  'is_default' => 1,));

        $this->assertSame('contact_department', $obj->getModelId());
        $this->assertSame(1, $obj->getDepartmentId());
        $this->assertSame('Support Departments', $obj->getName());
        $this->assertSame('info@younet.co', $obj->getEmail());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());    }

    public function testParameters()
    {
        $obj = new ContactDepartment();

        // set data
        $obj->setDepartmentId(1);
        $obj->setName('Support Departments');
        $obj->setEmail('info@younet.co');
        $obj->setDescription('');
        $obj->setActive(1);
        $obj->setDefault(1);
        // assert same data
        $this->assertSame('contact_department', $obj->getModelId());
        $this->assertSame(1, $obj->getDepartmentId());
        $this->assertSame('Support Departments', $obj->getName());
        $this->assertSame('info@younet.co', $obj->getEmail());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());    }

    public function testSave()
    {
        $obj = new ContactDepartment(array (  'department_id' => 1,  'name' => 'Support Departments',  'email' => 'info@younet.co',  'description' => '',  'is_active' => 1,  'is_default' => 1,));

        $obj->save();

        /** @var ContactDepartment $obj */
        $obj = _model('contact_department')
            ->select()->where('department_id=?',1)->first();

        $this->assertSame('contact_department', $obj->getModelId());
        $this->assertSame(1, $obj->getDepartmentId());
        $this->assertSame('Support Departments', $obj->getName());
        $this->assertSame('info@younet.co', $obj->getEmail());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());    }

    public static function setUpBeforeClass()
    {
        _model('contact_department')
            ->delete()->where('department_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('contact_department')
            ->delete()->where('department_id=?',1)->execute();
    }
}