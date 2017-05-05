<?php

namespace Neutron\Pages\Model;

class PagesMemberItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesMemberItem(['list_id' => 5, 'user_id' => 7,]);

        $this->assertSame('pages_member_item', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(7, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new PagesMemberItem();

        // set data
        $obj->setId(5);
        $obj->setUserId(7);

        // assert same data
        $this->assertSame('pages_member_item', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(7, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new PagesMemberItem(['list_id' => 5, 'user_id' => 7,]);

        $obj->save();

        /** @var PagesMemberItem $obj */
        $obj = _with('pages_member_item')
            ->select()->where('list_id=?', 5)->where('user_id=?', 7)->first();

        $this->assertSame('pages_member_item', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(7, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        _with('pages_member_item')
            ->delete()->where('list_id=?', 5)->where('user_id=?', 7)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('pages_member_item')
            ->delete()->where('list_id=?', 5)->where('user_id=?', 7)->execute();
    }
}