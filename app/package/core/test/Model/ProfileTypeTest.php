<?php

namespace Neutron\Core\Model;

class ProfileTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileType(['internal_id' => 1, 'item_type' => 'user', 'catalog_id' => 1,]);

        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(1, $obj->getCatalogId());
    }

    public function testParameters()
    {
        $obj = new ProfileType();

        // set data
        $obj->setInternalId(1);
        $obj->setItemType('user');
        $obj->setCatalogId(1);
        // assert same data
        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(1, $obj->getCatalogId());
    }

    public function testSave()
    {
        $obj = new ProfileType(['internal_id' => 1, 'item_type' => 'user', 'catalog_id' => 1,]);

        $obj->save();

        /** @var ProfileType $obj */
        $obj = \Phpfox::model('profile_type')
            ->select()->where('internal_id=?', 1)->first();

        $this->assertSame('profile_type', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame(1, $obj->getCatalogId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('profile_type')
            ->delete()->where('internal_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('profile_type')
            ->delete()->where('internal_id=?', 1)->execute();
    }
}