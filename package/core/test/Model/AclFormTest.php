<?php
namespace Neutron\Core\Model;

class AclFormTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclForm();

        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('', $obj->getFormId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->isActive());    }

    public function testParameters()
    {
        $obj = new AclForm();

        // set data
        $obj->setFormId('');
        $obj->setPackageId('');
        $obj->setTitle('');
        $obj->setFormName('');
        $obj->setDescription('');
        $obj->setOrdering('');
        $obj->setActive('');
        // assert same data
        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('', $obj->getFormId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->isActive());    }

    public function testSave()
    {
        $obj = new AclForm();

        $obj->save();

        /** @var AclForm $obj */
        $obj = _model('acl_form')
            ->select()->where('form_id=?','')->first();

        $this->assertSame('acl_form', $obj->getModelId());
        $this->assertSame('', $obj->getFormId());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getFormName());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getOrdering());
        $this->assertSame('', $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('acl_form')
            ->delete()->where('form_id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_form')
            ->delete()->where('form_id=?','')->execute();
    }
}