<?php

namespace Neutron\User\Model;

class FriendListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendList();

        $this->assertSame('', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame('', $obj->getTypeId());
        $this->assertSame('', $obj->getName());
    }

    public function testParameters()
    {
        $obj = new FriendList();

        // set data
        $obj->setId('');
        $obj->setParentId('');
        $obj->setTypeId('');
        $obj->setName('');

        // assert same data
        $this->assertSame('', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame('', $obj->getTypeId());
        $this->assertSame('', $obj->getName());
    }

    public function testSave()
    {
        $obj = new FriendList();

        $obj->save();

        /** @var FriendList $obj */
        $obj = \Phpfox::model('')
            ->select()->where('list_id=?', '')->first();

        $this->assertSame('', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame('', $obj->getTypeId());
        $this->assertSame('', $obj->getName());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('')
            ->delete()->where('list_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('')
            ->delete()->where('list_id=?', '')->execute();
    }
}