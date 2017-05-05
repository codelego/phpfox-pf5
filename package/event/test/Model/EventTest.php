<?php

namespace Neutron\Events\Model;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Event(array (  'event_id' => 34,  'is_featured' => 1,  'is_sponsor' => 0,  'privacy_id' => 1,  'parent_id' => 33,  'poster_id' => 22,  'user_id' => 99,  'location_id' => 33,  'photo_id' => 17,  'start_at' => '2014-12-11 00:11:44',  'end_at' => '2014-12-12 00:11:44',  'created_at' => '2013-12-11 00:11:44',  'title' => 'exmple value test',  'poster_type' => 'user',  'parent_type' => 'pages',));

        $this->assertSame('', $obj->getModelId());
        $this->assertSame(34, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(33, $obj->getParentId());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(99, $obj->getUserId());
        $this->assertSame(33, $obj->getLocationId());
        $this->assertSame(17, $obj->getPhotoId());
        $this->assertSame('2014-12-11 00:11:44', $obj->getStartAt());
        $this->assertSame('2014-12-12 00:11:44', $obj->getEndAt());
        $this->assertSame('2013-12-11 00:11:44', $obj->getCreatedAt());
        $this->assertSame('exmple value test', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public function testParameters()
    {
        $obj = new Event();

        // set data
        $obj->setId(34);
        $obj->setFeatured(1);
        $obj->setSponsor(0);
        $obj->setPrivacyId(1);
        $obj->setParentId(33);
        $obj->setPosterId(22);
        $obj->setUserId(99);
        $obj->setLocationId(33);
        $obj->setPhotoId(17);
        $obj->setStartAt('2014-12-11 00:11:44');
        $obj->setEndAt('2014-12-12 00:11:44');
        $obj->setCreatedAt('2013-12-11 00:11:44');
        $obj->setTitle('exmple value test');
        $obj->setPosterType('user');
        $obj->setParentType('pages');

        // assert same data
        $this->assertSame('', $obj->getModelId());
        $this->assertSame(34, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(33, $obj->getParentId());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(99, $obj->getUserId());
        $this->assertSame(33, $obj->getLocationId());
        $this->assertSame(17, $obj->getPhotoId());
        $this->assertSame('2014-12-11 00:11:44', $obj->getStartAt());
        $this->assertSame('2014-12-12 00:11:44', $obj->getEndAt());
        $this->assertSame('2013-12-11 00:11:44', $obj->getCreatedAt());
        $this->assertSame('exmple value test', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public function testSave()
    {
        $obj = new Event(array (  'event_id' => 34,  'is_featured' => 1,  'is_sponsor' => 0,  'privacy_id' => 1,  'parent_id' => 33,  'poster_id' => 22,  'user_id' => 99,  'location_id' => 33,  'photo_id' => 17,  'start_at' => '2014-12-11 00:11:44',  'end_at' => '2014-12-12 00:11:44',  'created_at' => '2013-12-11 00:11:44',  'title' => 'exmple value test',  'poster_type' => 'user',  'parent_type' => 'pages',));

        $obj->save();

        /** @var Event $obj */
        $obj = \Phpfox::with('')
            ->select()->where('event_id=?',34)->first();

        $this->assertSame('', $obj->getModelId());
        $this->assertSame(34, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(33, $obj->getParentId());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(99, $obj->getUserId());
        $this->assertSame(33, $obj->getLocationId());
        $this->assertSame(17, $obj->getPhotoId());
        $this->assertSame('2014-12-11 00:11:44', $obj->getStartAt());
        $this->assertSame('2014-12-12 00:11:44', $obj->getEndAt());
        $this->assertSame('2013-12-11 00:11:44', $obj->getCreatedAt());
        $this->assertSame('exmple value test', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('')
            ->delete()->where('event_id=?',34)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('')
            ->delete()->where('event_id=?',34)->execute();
    }
}