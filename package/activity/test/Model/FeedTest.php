<?php

namespace Neutron\Activity\Model;

class FeedTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Feed([
            'feed_id'     => 16,
            'type_id'     => 4,
            'user_id'     => 4,
            'about_id'    => 44,
            'about_type'  => 'user',
            'poster_id'   => 22,
            'poster_type' => 'user',
            'parent_id'   => 52,
            'parent_type' => 'pages',
            'created_at'  => '2017-02-11 06:09:04',
        ]);

        $this->assertSame('feed', $obj->getModelId());
        $this->assertSame(16, $obj->getId());
        $this->assertSame(4, $obj->getTypeId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(52, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-02-11 06:09:04', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Feed();

        // set data
        $obj->setId(16);
        $obj->setTypeId(4);
        $obj->setUserId(4);
        $obj->setAboutId(44);
        $obj->setAboutType('user');
        $obj->setPosterId(22);
        $obj->setPosterType('user');
        $obj->setParentId(52);
        $obj->setParentType('pages');
        $obj->setCreatedAt('2017-02-11 06:09:04');

        // assert same data
        $this->assertSame('feed', $obj->getModelId());
        $this->assertSame(16, $obj->getId());
        $this->assertSame(4, $obj->getTypeId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(52, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-02-11 06:09:04', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Feed([
            'feed_id'     => 16,
            'type_id'     => 4,
            'user_id'     => 4,
            'about_id'    => 44,
            'about_type'  => 'user',
            'poster_id'   => 22,
            'poster_type' => 'user',
            'parent_id'   => 52,
            'parent_type' => 'pages',
            'created_at'  => '2017-02-11 06:09:04',
        ]);

        $obj->save();

        /** @var Feed $obj */
        $obj = _with('feed')
            ->select()->where('feed_id=?', 16)->first();

        $this->assertSame('feed', $obj->getModelId());
        $this->assertSame(16, $obj->getId());
        $this->assertSame(4, $obj->getTypeId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(52, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-02-11 06:09:04', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _with('feed')
            ->delete()->where('feed_id=?', 16)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('feed')
            ->delete()->where('feed_id=?', 16)->execute();
    }
}