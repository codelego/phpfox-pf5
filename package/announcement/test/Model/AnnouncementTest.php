<?php

namespace Neutron\Announcement\Model;

class AnnouncementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Announcement([
            'announcement_id' => 3,
            'user_id'         => 22,
            'title'           => '[annoucement title]',
            'photo_file_id'   => 44,
            'description'     => '[descrition]',
            'is_active'       => 1,
            'type_id'         => 6,
            'content'         => '[content]',
            'created_at'      => '2012-01-01 00:00:00',
            'updated_at'      => '2013-01-01 00:00:00',
            'publish_at'      => '2014-01-01 00:00:00',
            'expires_at'      => '2015-01-01 00:00:00',
        ]);

        $this->assertSame('announcement', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[annoucement title]', $obj->getTitle());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('[descrition]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame('[content]', $obj->getContent());
        $this->assertSame('2012-01-01 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2013-01-01 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('2014-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame('2015-01-01 00:00:00', $obj->getExpiresAt());
    }

    public function testParameters()
    {
        $obj = new Announcement();

        // set data
        $obj->setId(3);
        $obj->setUserId(22);
        $obj->setTitle('[annoucement title]');
        $obj->setPhotoFileId(44);
        $obj->setDescription('[descrition]');
        $obj->setActive(1);
        $obj->setTypeId(6);
        $obj->setContent('[content]');
        $obj->setCreatedAt('2012-01-01 00:00:00');
        $obj->setUpdatedAt('2013-01-01 00:00:00');
        $obj->setPublishAt('2014-01-01 00:00:00');
        $obj->setExpiresAt('2015-01-01 00:00:00');

        // assert same data
        $this->assertSame('announcement', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[annoucement title]', $obj->getTitle());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('[descrition]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame('[content]', $obj->getContent());
        $this->assertSame('2012-01-01 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2013-01-01 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('2014-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame('2015-01-01 00:00:00', $obj->getExpiresAt());
    }

    public function testSave()
    {
        $obj = new Announcement([
            'announcement_id' => 3,
            'user_id'         => 22,
            'title'           => '[annoucement title]',
            'photo_file_id'   => 44,
            'description'     => '[descrition]',
            'is_active'       => 1,
            'type_id'         => 6,
            'content'         => '[content]',
            'created_at'      => '2012-01-01 00:00:00',
            'updated_at'      => '2013-01-01 00:00:00',
            'publish_at'      => '2014-01-01 00:00:00',
            'expires_at'      => '2015-01-01 00:00:00',
        ]);

        $obj->save();

        /** @var Announcement $obj */
        $obj = _with('announcement')
            ->select()->where('announcement_id=?', 3)->first();

        $this->assertSame('announcement', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[annoucement title]', $obj->getTitle());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('[descrition]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(6, $obj->getTypeId());
        $this->assertSame('[content]', $obj->getContent());
        $this->assertSame('2012-01-01 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2013-01-01 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('2014-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame('2015-01-01 00:00:00', $obj->getExpiresAt());
    }

    public static function setUpBeforeClass()
    {
        _with('announcement')
            ->delete()->where('announcement_id=?', 3)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('announcement')
            ->delete()->where('announcement_id=?', 3)->execute();
    }
}