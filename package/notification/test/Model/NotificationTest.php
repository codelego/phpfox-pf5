<?php

namespace Neutron\Notification\Model;

class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Notification([
            'id'           => 3,
            'user_id'      => 1,
            'poster_type'  => 12,
            'poster_id'    => 33,
            'about_type'   => 'blog_post',
            'about_id'     => 233,
            'type_id'      => 'comment',
            'params'       => '[test]',
            'is_read'      => 1,
            'is_mitigated' => 0,
            'created_at'   => '2012-10-10 10:10:09',
        ]);

        $this->assertSame('notification', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(1, $obj->getUserId());
        $this->assertSame(12, $obj->getPosterType());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(233, $obj->getAboutId());
        $this->assertSame('comment', $obj->getTypeId());
        $this->assertSame('[test]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-10 10:10:09', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Notification();

        // set data
        $obj->setId(3);
        $obj->setUserId(1);
        $obj->setPosterType(12);
        $obj->setPosterId(33);
        $obj->setAboutType('blog_post');
        $obj->setAboutId(233);
        $obj->setTypeId('comment');
        $obj->setParams('[test]');
        $obj->setRead(1);
        $obj->setMitigated(0);
        $obj->setCreatedAt('2012-10-10 10:10:09');

        // assert same data
        $this->assertSame('notification', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(1, $obj->getUserId());
        $this->assertSame(12, $obj->getPosterType());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(233, $obj->getAboutId());
        $this->assertSame('comment', $obj->getTypeId());
        $this->assertSame('[test]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-10 10:10:09', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Notification([
            'id'           => 3,
            'user_id'      => 1,
            'poster_type'  => 12,
            'poster_id'    => 33,
            'about_type'   => 'blog_post',
            'about_id'     => 233,
            'type_id'      => 'comment',
            'params'       => '[test]',
            'is_read'      => 1,
            'is_mitigated' => 0,
            'created_at'   => '2012-10-10 10:10:09',
        ]);

        $obj->save();

        /** @var Notification $obj */
        $obj = _with('notification')
            ->select()->where('id=?', 3)->first();

        $this->assertSame('notification', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(1, $obj->getUserId());
        $this->assertSame(12, $obj->getPosterType());
        $this->assertSame(33, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(233, $obj->getAboutId());
        $this->assertSame('comment', $obj->getTypeId());
        $this->assertSame('[test]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-10 10:10:09', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _with('notification')
            ->delete()->where('id=?', 3)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('notification')
            ->delete()->where('id=?', 3)->execute();
    }
}