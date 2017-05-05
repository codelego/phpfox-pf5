<?php

namespace Neutron\Comment\Model;


class CommentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Comment([
            'comment_id'  => 33,
            'user_id'     => 4,
            'about_id'    => 2,
            'poster_id'   => 33,
            'about_type'  => 'blog_post',
            'poster_type' => 'pages',
            'parent_id'   => 44,
            'parent_type' => 'event',
            'created_at'  => '2011-10-09 22:11:00',
            'content'     => '[example comment content]',
        ]);

        $this->assertSame(33, $obj->getId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(2, $obj->getAboutId());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame('event', $obj->getParentType());
        $this->assertSame('2011-10-09 22:11:00', $obj->getCreatedAt());
        $this->assertSame('[example comment content]', $obj->getContent());
    }

    public function testParameters()
    {
        $obj = new Comment();

        $obj->setId(33);
        $obj->setUserId(4);
        $obj->setAboutId(2);
        $obj->setPosterId(33);
        $obj->setParentId(44);
        $obj->setPosterType('pages');
        $obj->setParentType('event');
        $obj->setAboutType('blog_post');
        $obj->setCreatedAt('2011-10-09 22:11:00');
        $obj->setContent('[example comment content]');

        $this->assertSame(33, $obj->getId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(2, $obj->getAboutId());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame('event', $obj->getParentType());
        $this->assertSame('2011-10-09 22:11:00', $obj->getCreatedAt());
        $this->assertSame('[example comment content]', $obj->getContent());
    }

    public function testSave()
    {
        $obj = new Comment();

        $obj->setUserId(4);
        $obj->setAboutId(2);
        $obj->setPosterId(33);
        $obj->setParentId(44);
        $obj->setPosterType('pages');
        $obj->setParentType('event');
        $obj->setAboutType('blog_post');
        $obj->setCreatedAt('2011-10-09 22:11:00');
        $obj->setContent('[example comment content]');

        $obj->save();

        /** @var Comment $obj */
        $obj = _model('comment')
            ->select()
            ->where('poster_id=?', 33)
            ->where('about_id=?', 2)
            ->where('about_type=?', 'blog_post')
            ->where('poster_type=?', 'pages')
            ->first();

        $this->assertNotNull($obj);
        $this->assertTrue($obj instanceof Comment);

        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(2, $obj->getAboutId());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame('event', $obj->getParentType());
        $this->assertSame('2011-10-09 22:11:00', $obj->getCreatedAt());
        $this->assertSame('[example comment content]', $obj->getContent());
    }

    public static function tearDownAfterClass()
    {
        _model('comment')
            ->delete()
            ->where('poster_id=?', 33)
            ->where('about_id=?', 2)
            ->where('about_type=?', 'blog_post')
            ->where('poster_type=?', 'pages')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        _model('comment')
            ->delete()
            ->where('poster_id=?', 33)
            ->where('about_id=?', 2)
            ->where('about_type=?', 'blog_post')
            ->where('poster_type=?', 'pages')
            ->execute();
    }
}
