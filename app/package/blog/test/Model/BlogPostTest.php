<?php

namespace Neutron\Blog\Model;

class BlogPostTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new BlogPost(['blog_id'       => 1,
                             'title'         => 'dddd',
                             'content'       => 'ddd',
                             'parent_type'   => '',
                             'description'   => 'dddd',
                             'parent_id'     => 0,
                             'category_id'   => 0,
                             'created_at'    => '0000-00-00 00:00:00',
                             'updated_at'    => '0000-00-00 00:00:00',
                             'poster_type'   => '',
                             'poster_id'     => 0,
                             'publish_at'    => '0000-00-00 00:00:00',
                             'view_count'    => 0,
                             'comment_count' => 0,
                             'privacy_id'    => 1,
                             'status_id'     => 1,
                             'is_approved'   => 0,
                             'is_featured'   => 1,
                             'user_id'       => 0,
        ]);

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('dddd', $obj->getTitle());
        $this->assertSame('ddd', $obj->getContent());
        $this->assertSame('', $obj->getParentType());
        $this->assertSame('dddd', $obj->getDescription());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('', $obj->getPosterType());
        $this->assertSame(0, $obj->getPosterId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(1, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new BlogPost();

        // set data
        $obj->setId(1);
        $obj->setTitle('dddd');
        $obj->setContent('ddd');
        $obj->setParentType('');
        $obj->setDescription('dddd');
        $obj->setParentId(0);
        $obj->setCategoryId(0);
        $obj->setCreatedAt('0000-00-00 00:00:00');
        $obj->setUpdatedAt('0000-00-00 00:00:00');
        $obj->setPosterType('');
        $obj->setPosterId(0);
        $obj->setPublishAt('0000-00-00 00:00:00');
        $obj->setViewCount(0);
        $obj->setCommentCount(0);
        $obj->setPrivacyId(1);
        $obj->setStatusId(1);
        $obj->setApproved(0);
        $obj->setFeatured(1);
        $obj->setUserId(0);

        // assert same data
        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('dddd', $obj->getTitle());
        $this->assertSame('ddd', $obj->getContent());
        $this->assertSame('', $obj->getParentType());
        $this->assertSame('dddd', $obj->getDescription());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('', $obj->getPosterType());
        $this->assertSame(0, $obj->getPosterId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(1, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new BlogPost(['blog_id'       => 1,
                             'title'         => 'dddd',
                             'content'       => 'ddd',
                             'parent_type'   => '',
                             'description'   => 'dddd',
                             'parent_id'     => 0,
                             'category_id'   => 0,
                             'created_at'    => '0000-00-00 00:00:00',
                             'updated_at'    => '0000-00-00 00:00:00',
                             'poster_type'   => '',
                             'poster_id'     => 0,
                             'publish_at'    => '0000-00-00 00:00:00',
                             'view_count'    => 0,
                             'comment_count' => 0,
                             'privacy_id'    => 1,
                             'status_id'     => 1,
                             'is_approved'   => 0,
                             'is_featured'   => 1,
                             'user_id'       => 0,
        ]);

        $obj->save();

        /** @var BlogPost $obj */
        $obj = \Phpfox::model('blog_post')
            ->select()->where('blog_id=?', 1)->first();

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('dddd', $obj->getTitle());
        $this->assertSame('ddd', $obj->getContent());
        $this->assertSame('', $obj->getParentType());
        $this->assertSame('dddd', $obj->getDescription());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('', $obj->getPosterType());
        $this->assertSame(0, $obj->getPosterId());
        $this->assertSame('0000-00-00 00:00:00', $obj->getPublishAt());
        $this->assertSame(0, $obj->getViewCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame(1, $obj->getPrivacyId());
        $this->assertSame(1, $obj->getStatusId());
        $this->assertSame(0, $obj->isApproved());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('blog_post')
            ->delete()->where('blog_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('blog_post')
            ->delete()->where('blog_id=?', 1)->execute();
    }
}