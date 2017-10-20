<?php
namespace Neutron\Marketplace\Model;

class MarketplaceCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MarketplaceCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Example',  'description' => NULL,));

        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Example', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new MarketplaceCategory();

        // set data
        $obj->setCategoryId(1);
        $obj->setActive(1);
        $obj->setName('Example');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Example', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new MarketplaceCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Example',  'description' => NULL,));

        $obj->save();

        /** @var MarketplaceCategory $obj */
        $obj = _model('marketplace_category')
            ->select()->where('category_id=?',1)->first();

        $this->assertSame('marketplace_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Example', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('marketplace_category')
            ->delete()->where('category_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('marketplace_category')
            ->delete()->where('category_id=?',1)->execute();
    }
}