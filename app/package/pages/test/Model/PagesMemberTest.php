<?php

namespace Neutron\Pages\Model;

class PagesMemberTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesMember([
            'parent_id' => 1,
            'user_id'   => 4,
            'type_id'   => 6,
            'is_active' => 1,
        ]);

        $this->assertSame('pages_member', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new PagesMember();

        // set data
        $obj->setParentId(1);
        $obj->setUserId(4);
        $obj->setTypeId(6);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('pages_member', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new PagesMember([
            'parent_id' => 1,
            'user_id'   => 4,
            'type_id'   => 6,
            'is_active' => 1,
        ]);

        $obj->save();

        /** @var PagesMember $obj */
        $obj = \Phpfox::model('pages_member')
            ->select()->where('parent_id=?', 1)->where('user_id=?', 4)
            ->where('type_id=?', 6)->where('is_active=?', 1)->first();

        $this->assertSame('pages_member', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('pages_member')
            ->delete()->where('parent_id=?', 1)->where('user_id=?', 4)
            ->where('type_id=?', 6)->where('is_active=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('pages_member')
            ->delete()->where('parent_id=?', 1)->where('user_id=?', 4)
            ->where('type_id=?', 6)->where('is_active=?', 1)->execute();
    }
}