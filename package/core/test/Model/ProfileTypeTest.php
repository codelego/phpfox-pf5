<?php
namespace Neutron\Core\Model;

class ProfileTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileType(array (  'internal_id' => 1,  'item_type' => 'user',  'catalog_id' => 0,  'ordering' => 10,));

        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(0, $obj->getCatalogId());
        $this->assertSame(10, $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new ProfileType();

        // set data
        $obj->setInternalId(1);
        $obj->setItemType('user');
        $obj->setCatalogId(0);
        $obj->setOrdering(10);
        // assert same data
        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(0, $obj->getCatalogId());
        $this->assertSame(10, $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new ProfileType(array (  'internal_id' => 1,  'item_type' => 'user',  'catalog_id' => 0,  'ordering' => 10,));

        $obj->save();

        /** @var ProfileType $obj */
        $obj = _model('profile_type')
            ->select()->where('internal_id=?',1)->first();

        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(0, $obj->getCatalogId());
        $this->assertSame(10, $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('profile_type')
            ->delete()->where('internal_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_type')
            ->delete()->where('internal_id=?',1)->execute();
    }
}