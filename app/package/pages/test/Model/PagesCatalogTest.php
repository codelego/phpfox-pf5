<?php
namespace Neutron\Pages\Model;

class PagesCatalogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesCatalog();

        $this->assertSame('pages_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new PagesCatalog();

        // set data
        $obj->setCatalogId('');
        $obj->setName('');
        $obj->setTitle('');
        $obj->setDescription('');
        $obj->setActive('');
        $obj->setCore('');
        $obj->setOrdering('');
        // assert same data
        $this->assertSame('pages_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new PagesCatalog();

        $obj->save();

        /** @var PagesCatalog $obj */
        $obj = _model('pages_catalog')
            ->select()->where('catalog_id=?','')->first();

        $this->assertSame('pages_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('pages_catalog')
            ->delete()->where('catalog_id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('pages_catalog')
            ->delete()->where('catalog_id=?','')->execute();
    }
}