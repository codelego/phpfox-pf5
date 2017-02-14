<?php

namespace Neutron\Link\Model;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Link(['link_id'       => 1,
                         'url'           => 'http://tuoitre.vn/',
                         'title'         => 'tuoitre.vn',
                         'description'   => '[description]',
                         'user_id'       => 22,
                         'photo_file_id' => 44,
                         'parent_type'   => 'pages',
                         'parent_id'     => 12,
                         'poster_type'   => 'user',
                         'poster_id'     => 22,
                         'view_count'    => 44,
                         'like_count'    => 34,
                         'comment_count' => 56,
                         'created_at'    => '2013-11-03 00:00:00',
                         'privacy_id'    => 26,
        ]);

        $this->assertSame('link', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('http://tuoitre.vn/', $obj->getUrl());
        $this->assertSame('tuoitre.vn', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(44, $obj->getViewCount());
        $this->assertSame(34, $obj->getLikeCount());
        $this->assertSame(56, $obj->getCommentCount());
        $this->assertSame('2013-11-03 00:00:00', $obj->getCreatedAt());
        $this->assertSame(26, $obj->getPrivacyId());
    }

    public function testParameters()
    {
        $obj = new Link();

        // set data
        $obj->setId(1);
        $obj->setUrl('http://tuoitre.vn/');
        $obj->setTitle('tuoitre.vn');
        $obj->setDescription('[description]');
        $obj->setUserId(22);
        $obj->setPhotoFileId(44);
        $obj->setParentType('pages');
        $obj->setParentId(12);
        $obj->setPosterType('user');
        $obj->setPosterId(22);
        $obj->setViewCount(44);
        $obj->setLikeCount(34);
        $obj->setCommentCount(56);
        $obj->setCreatedAt('2013-11-03 00:00:00');
        $obj->setPrivacyId(26);

        // assert same data
        $this->assertSame('link', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('http://tuoitre.vn/', $obj->getUrl());
        $this->assertSame('tuoitre.vn', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(44, $obj->getViewCount());
        $this->assertSame(34, $obj->getLikeCount());
        $this->assertSame(56, $obj->getCommentCount());
        $this->assertSame('2013-11-03 00:00:00', $obj->getCreatedAt());
        $this->assertSame(26, $obj->getPrivacyId());
    }

    public function testSave()
    {
        $obj = new Link(['link_id'       => 1,
                         'url'           => 'http://tuoitre.vn/',
                         'title'         => 'tuoitre.vn',
                         'description'   => '[description]',
                         'user_id'       => 22,
                         'photo_file_id' => 44,
                         'parent_type'   => 'pages',
                         'parent_id'     => 12,
                         'poster_type'   => 'user',
                         'poster_id'     => 22,
                         'view_count'    => 44,
                         'like_count'    => 34,
                         'comment_count' => 56,
                         'created_at'    => '2013-11-03 00:00:00',
                         'privacy_id'    => 26,
        ]);

        $obj->save();

        /** @var Link $obj */
        $obj = \Phpfox::with('link')
            ->select()->where('link_id=?', 1)->first();

        $this->assertSame('link', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('http://tuoitre.vn/', $obj->getUrl());
        $this->assertSame('tuoitre.vn', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(44, $obj->getPhotoFileId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(22, $obj->getPosterId());
        $this->assertSame(44, $obj->getViewCount());
        $this->assertSame(34, $obj->getLikeCount());
        $this->assertSame(56, $obj->getCommentCount());
        $this->assertSame('2013-11-03 00:00:00', $obj->getCreatedAt());
        $this->assertSame(26, $obj->getPrivacyId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('link')
            ->delete()->where('link_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('link')
            ->delete()->where('link_id=?', 1)->execute();
    }
}