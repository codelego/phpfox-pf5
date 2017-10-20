<?php
namespace Neutron\Event\Model;

class EventCatalogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventCatalog();

        $this->assertSame('event_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new EventCatalog();

        // set data
        $obj->setCatalogId('');
        $obj->setName('');
        $obj->setTitle('');
        $obj->setDescription('');
        $obj->setActive('');
        $obj->setCore('');
        $obj->setOrdering('');
        // assert same data
        $this->assertSame('event_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new EventCatalog();

        $obj->save();

        /** @var EventCatalog $obj */
        $obj = _model('event_catalog')
            ->select()->where('catalog_id=?','')->first();

        $this->assertSame('event_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('event_catalog')
            ->delete()->where('catalog_id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('event_catalog')
            ->delete()->where('catalog_id=?','')->execute();
    }
}