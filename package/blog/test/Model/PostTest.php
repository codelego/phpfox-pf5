<?php

namespace Neutron\Blog\Model;


class PostTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Post([
            'id'          => 2,
            'category_id' => 3,
            'poster_id'   => 44,
            'user_id'     => 45,
            'parent_id'   => 22,
            'poster_type' => 'user',
            'parent_type' => 'pages',
            'created_at'  => '2017-01-18 08:56:34',
            'updated_at'  => '2017-01-18 08:56:32',
            'title'       => '[post title]',
            'description' => '[post description]',
            'content'     => '[post content]',
        ]);

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(45, $obj->getUserId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('[post title]', $obj->getTitle());
        $this->assertSame('[post description]', $obj->getDescription());
        $this->assertSame('[post content]', $obj->getContent());
    }

    public function testObject()
    {
        $obj = new Post();

        $obj->setId(2);
        $obj->setCategoryId(3);
        $obj->setPosterId(44);
        $obj->setUserId(45);
        $obj->setParentId(22);
        $obj->setParentType('pages');
        $obj->setPosterType('user');
        $obj->setCreatedAt('2017-01-18 08:56:34');
        $obj->setUpdatedAt('2017-01-18 08:56:32');
        $obj->setTitle('[post title]');
        $obj->setDescription('[post description]');
        $obj->setContent('[post content]');

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(45, $obj->getUserId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('[post title]', $obj->getTitle());
        $this->assertSame('[post description]', $obj->getDescription());
        $this->assertSame('[post content]', $obj->getContent());
    }

    public function testSave()
    {
        $obj = new Post([
            'category_id' => 3,
            'poster_id'   => 44,
            'user_id'     => 45,
            'parent_id'   => 22,
            'poster_type' => 'user',
            'parent_type' => 'pages',
            'created_at'  => '2017-01-18 08:56:34',
            'updated_at'  => '2017-01-18 08:56:32',
            'title'       => '[unit_test_title]',
            'description' => '[post description]',
            'content'     => '[post content]',
        ]);

        $obj->save();

        /** @var Post $obj */
        $obj = \Phpfox::with('blog_post')
            ->select()
            ->where('title=?', '[unit_test_title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->first();

        $this->assertNotNull($obj);

        $this->assertSame('blog_post', $obj->getModelId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame(44, $obj->getPosterId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(45, $obj->getUserId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:56:32', $obj->getUpdatedAt());
        $this->assertSame('[unit_test_title]', $obj->getTitle());
        $this->assertSame('[post description]', $obj->getDescription());
        $this->assertSame('[post content]', $obj->getContent());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')
            ->delete(':blog_post')
            ->where('title=?', '[unit_test_title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':blog_post')
            ->where('title=?', '[unit_test_title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->execute();
    }

}
