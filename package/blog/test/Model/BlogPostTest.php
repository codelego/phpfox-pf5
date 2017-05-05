<?php

namespace Neutron\Blog\Model;

class BlogPostTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new BlogPost([
            'blog_id'       => 4,
            'title'         => '[unit_test_title]',
            'content'       => '[post content]',
            'parent_type'   => 'pages',
            'description'   => '',
            'parent_id'     => 22,
            'category_id'   => 3,
            'created_at'    => '2017-01-18 08:56:34',
            'updated_at'    => '2017-01-18 08:56:32',
            'poster_type'   => 'user',
            'poster_id'     => 44,
            'publish_at'    => '2016-01-01 00:00:00',
            'view_count'    => 0,
            'comment_count' => 0,
            'privacy_id'    => 0,
            'status_id'     => 0,
            'is_approved'   => 0,
            'is_featured'   => 0,
            'user_id'       => 45,
        ]);

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame('[unit_test_title]', $obj->getTitle());
        $this->assertSame('[post content]', $obj->getContent());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame('2016-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(0, $obj->getPrivacyId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(45, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new BlogPost();

        // set data
        $obj->setId(4);
        $obj->setTitle('[unit_test_title]');
        $obj->setContent('[post content]');
        $obj->setParentType('pages');
        $obj->setDescription('');
        $obj->setParentId(22);
        $obj->setCategoryId(3);
        $obj->setCreatedAt('2017-01-18 08:56:34');
        $obj->setUpdatedAt('2017-01-18 08:56:32');
        $obj->setPosterType('user');
        $obj->setPosterId(44);
        $obj->setPublishAt('2016-01-01 00:00:00');
        $obj->setViewCount(0);
        $obj->setCommentCount(0);
        $obj->setPrivacyId(0);
        $obj->setStatusId(0);
        $obj->setApproved(0);
        $obj->setFeatured(0);
        $obj->setUserId(45);

        // assert same data
        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame('[unit_test_title]', $obj->getTitle());
        $this->assertSame('[post content]', $obj->getContent());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame('2016-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(0, $obj->getPrivacyId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(45, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new BlogPost([
            'blog_id'       => 4,
            'title'         => '[unit_test_title]',
            'content'       => '[post content]',
            'parent_type'   => 'pages',
            'description'   => 'example',
            'parent_id'     => 22,
            'category_id'   => 3,
            'created_at'    => '2017-01-18 08:56:34',
            'updated_at'    => '2017-01-18 08:56:32',
            'poster_type'   => 'user',
            'poster_id'     => 44,
            'publish_at'    => '2016-01-01 00:00:00',
            'view_count'    => 0,
            'comment_count' => 0,
            'privacy_id'    => 0,
            'status_id'     => 0,
            'is_approved'   => 0,
            'is_featured'   => 0,
            'user_id'       => 45,
        ]);

        $obj->save();

        /** @var BlogPost $obj */
        $obj = _with('blog_post')
            ->select()->where('blog_id=?', 4)->first();

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame('[unit_test_title]', $obj->getTitle());
        $this->assertSame('[post content]', $obj->getContent());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('example', $obj->getDescription());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame('2016-01-01 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(0, $obj->getPrivacyId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(45, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        _with('blog_post')
            ->delete()->where('blog_id=?', 4)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('blog_post')
            ->delete()->where('blog_id=?', 4)->execute();
    }
}