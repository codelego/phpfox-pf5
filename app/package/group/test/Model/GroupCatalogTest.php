<?php

namespace Neutron\Group\Model;

class GroupCatalogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupCatalog();

        $this->assertSame('group_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());
    }

    public function testParameters()
    {
        $obj = new GroupCatalog();

        // set data
        $obj->setCatalogId('');
        $obj->setName('');
        $obj->setTitle('');
        $obj->setDescription('');
        $obj->setActive('');
        $obj->setCore('');
        $obj->setOrdering('');
        // assert same data
        $this->assertSame('group_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());
    }

    public function testSave()
    {
        $obj = new GroupCatalog();

        $obj->save();

        /** @var GroupCatalog $obj */
        $obj = \Phpfox::model('group_catalog')
            ->select()->where('catalog_id=?', '')->first();

        $this->assertSame('group_catalog', $obj->getModelId());
        $this->assertSame('', $obj->getCatalogId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isCore());
        $this->assertSame('', $obj->getOrdering());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('group_catalog')
            ->delete()->where('catalog_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('group_catalog')
            ->delete()->where('catalog_id=?', '')->execute();
    }
}