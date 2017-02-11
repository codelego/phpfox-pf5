<?php

namespace Neutron\Event\Model;


class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Event([
            'event_id'    => 33,
            'is_featured' => 1,
            'is_sponsor'  => 1,
            'privacy_id'  => 4,
            'parent_id'   => 44,
            'poster_id'   => 23,
            'user_id'     => 56,
            'location_id' => 12,
            'photo_id'    => 98,
            'start_at'    => '2012-10-09 00:22:11',
            'end_at'      => '2012-10-09 11:22:11',
            'created_at'  => '2012-10-09 08:22:11',
            'title'       => '[example event]',
            'poster_type' => 'user',
            'parent_type' => 'pages',
        ]);

        $this->assertSame('event', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(1, $obj->isSponsor());
        $this->assertSame(4, $obj->getPrivacyId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(23, $obj->getPosterId());
        $this->assertSame(56, $obj->getUserId());
        $this->assertSame(12, $obj->getLocationId());
        $this->assertSame(98, $obj->getPhotoId());
        $this->assertSame('2012-10-09 00:22:11', $obj->getStartAt());
        $this->assertSame('2012-10-09 11:22:11', $obj->getEndAt());
        $this->assertSame('2012-10-09 08:22:11', $obj->getCreatedAt());
        $this->assertSame('[example event]', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public function testParameters()
    {
        $obj = new Event();

        // set data
        $obj->setId(33);
        $obj->setFeatured(1);
        $obj->setSponsor(1);
        $obj->setPrivacyId(4);
        $obj->setParentId(44);
        $obj->setPosterId(23);
        $obj->setUserId(56);
        $obj->setLocationId(12);
        $obj->setPhotoId(98);
        $obj->setStartAt('2012-10-09 00:22:11');
        $obj->setEndAt('2012-10-09 11:22:11');
        $obj->setCreatedAt('2012-10-09 08:22:11');
        $obj->setTitle('[example event]');
        $obj->setPosterType('user');
        $obj->setParentType('pages');

        // assert same data
        $this->assertSame('event', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(1, $obj->isSponsor());
        $this->assertSame(4, $obj->getPrivacyId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(23, $obj->getPosterId());
        $this->assertSame(56, $obj->getUserId());
        $this->assertSame(12, $obj->getLocationId());
        $this->assertSame(98, $obj->getPhotoId());
        $this->assertSame('2012-10-09 00:22:11', $obj->getStartAt());
        $this->assertSame('2012-10-09 11:22:11', $obj->getEndAt());
        $this->assertSame('2012-10-09 08:22:11', $obj->getCreatedAt());
        $this->assertSame('[example event]', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public function testSave()
    {
        $obj = new Event([
            'event_id'    => 33,
            'is_featured' => 1,
            'is_sponsor'  => 1,
            'privacy_id'  => 4,
            'parent_id'   => 44,
            'poster_id'   => 23,
            'user_id'     => 56,
            'location_id' => 12,
            'photo_id'    => 98,
            'start_at'    => '2012-10-09 00:22:11',
            'end_at'      => '2012-10-09 11:22:11',
            'created_at'  => '2012-10-09 08:22:11',
            'title'       => '[example event]',
            'poster_type' => 'user',
            'parent_type' => 'pages',
        ]);

        $obj->save();

        /** @var Event $obj */
        $obj = \Phpfox::with('event')
            ->select()
            ->where('event_id=?', 33)
            ->first();

        $this->assertSame('event', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(1, $obj->isSponsor());
        $this->assertSame(4, $obj->getPrivacyId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(23, $obj->getPosterId());
        $this->assertSame(56, $obj->getUserId());
        $this->assertSame(12, $obj->getLocationId());
        $this->assertSame(98, $obj->getPhotoId());
        $this->assertSame('2012-10-09 00:22:11', $obj->getStartAt());
        $this->assertSame('2012-10-09 11:22:11', $obj->getEndAt());
        $this->assertSame('2012-10-09 08:22:11', $obj->getCreatedAt());
        $this->assertSame('[example event]', $obj->getTitle());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('event')
            ->delete()
            ->where('event_id=?', 33)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('event')
            ->delete()
            ->where('event_id=?', 33)
            ->execute();
    }
}