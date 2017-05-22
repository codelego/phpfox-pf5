<?php
namespace Neutron\User\Model;

class UserCatalogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new UserCatalog(array (  'catalog_id' => 1,  'catalog_name' => 'default',  'catalog_label' => 'Standard',  'catalog_description' => 'Standard user',  'is_active' => 1,  'is_system' => 1,  'ordering' => 10,));

        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getCatalogName());
        $this->assertSame('Standard', $obj->getCatalogLabel());
        $this->assertSame('Standard user', $obj->getCatalogDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(10, $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new UserCatalog();

        // set data
        $obj->setCatalogId(1);
        $obj->setCatalogName('default');
        $obj->setCatalogLabel('Standard');
        $obj->setCatalogDescription('Standard user');
        $obj->setActive(1);
        $obj->setSystem(1);
        $obj->setOrdering(10);
        // assert same data
        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getCatalogName());
        $this->assertSame('Standard', $obj->getCatalogLabel());
        $this->assertSame('Standard user', $obj->getCatalogDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(10, $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new UserCatalog(array (  'catalog_id' => 1,  'catalog_name' => 'default',  'catalog_label' => 'Standard',  'catalog_description' => 'Standard user',  'is_active' => 1,  'is_system' => 1,  'ordering' => 10,));

        $obj->save();

        /** @var UserCatalog $obj */
        $obj = _model('user_catalog')
            ->select()->where('catalog_id=?',1)->first();

        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getCatalogName());
        $this->assertSame('Standard', $obj->getCatalogLabel());
        $this->assertSame('Standard user', $obj->getCatalogDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(10, $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('user_catalog')
            ->delete()->where('catalog_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('user_catalog')
            ->delete()->where('catalog_id=?',1)->execute();
    }
}