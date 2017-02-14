<?php

namespace Neutron\Request\Model;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Request([
            'id'           => 1,
            'user_id'      => 22,
            'poster_type'  => 'pages',
            'poster_id'    => 27,
            'about_type'   => 'blog_post',
            'about_id'     => 44,
            'type_id'      => 'auth_comment_tset',
            'params'       => '[]',
            'is_read'      => 1,
            'is_mitigated' => 0,
            'created_at'   => '2012-10-01 10:10:02',
        ]);

        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(27, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('auth_comment_tset', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-01 10:10:02', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Request();

        // set data
        $obj->setId(1);
        $obj->setUserId(22);
        $obj->setPosterType('pages');
        $obj->setPosterId(27);
        $obj->setAboutType('blog_post');
        $obj->setAboutId(44);
        $obj->setTypeId('auth_comment_tset');
        $obj->setParams('[]');
        $obj->setRead(1);
        $obj->setMitigated(0);
        $obj->setCreatedAt('2012-10-01 10:10:02');

        // assert same data
        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(27, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('auth_comment_tset', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-01 10:10:02', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Request([
            'id'           => 1,
            'user_id'      => 22,
            'poster_type'  => 'pages',
            'poster_id'    => 27,
            'about_type'   => 'blog_post',
            'about_id'     => 44,
            'type_id'      => 'auth_comment_tset',
            'params'       => '[]',
            'is_read'      => 1,
            'is_mitigated' => 0,
            'created_at'   => '2012-10-01 10:10:02',
        ]);

        $obj->save();

        /** @var Request $obj */
        $obj = \Phpfox::with('request')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(27, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(44, $obj->getAboutId());
        $this->assertSame('auth_comment_tset', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2012-10-01 10:10:02', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('request')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('request')
            ->delete()->where('id=?', 1)->execute();
    }
}