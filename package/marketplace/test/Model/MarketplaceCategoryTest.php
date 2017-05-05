<?php

namespace Neutron\Marketplace\Model;

class MarketplaceCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MarketplaceCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new MarketplaceCategory();

        // set data
        $obj->setId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new MarketplaceCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var MarketplaceCategory $obj */
        $obj = _model('marketplace_category')
            ->select()->where('category_id=?', 12)->first();

        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('marketplace_category')
            ->delete()->where('category_id=?', 12)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('marketplace_category')
            ->delete()->where('category_id=?', 12)->execute();
    }
}