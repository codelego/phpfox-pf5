<?php
namespace Neutron\User\Model;

class UserCatalogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new UserCatalog(array (  'catalog_id' => 1,  'name' => 'default',  'title' => 'Standard',  'description' => 'Standard user',  'is_active' => 1,  'is_core' => 1,  'ordering' => 2,));

        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getName());
        $this->assertSame('Standard', $obj->getTitle());
        $this->assertSame('Standard user', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(2, $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new UserCatalog();

        // set data
        $obj->setCatalogId(1);
        $obj->setName('default');
        $obj->setTitle('Standard');
        $obj->setDescription('Standard user');
        $obj->setActive(1);
        $obj->setCore(1);
        $obj->setOrdering(2);
        // assert same data
        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getName());
        $this->assertSame('Standard', $obj->getTitle());
        $this->assertSame('Standard user', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(2, $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new UserCatalog(array (  'catalog_id' => 1,  'name' => 'default',  'title' => 'Standard',  'description' => 'Standard user',  'is_active' => 1,  'is_core' => 1,  'ordering' => 2,));

        $obj->save();

        /** @var UserCatalog $obj */
        $obj = _model('user_catalog')
            ->select()->where('catalog_id=?',1)->first();

        $this->assertSame('user_catalog', $obj->getModelId());
        $this->assertSame(1, $obj->getCatalogId());
        $this->assertSame('default', $obj->getName());
        $this->assertSame('Standard', $obj->getTitle());
        $this->assertSame('Standard user', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(2, $obj->getOrdering());    }

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