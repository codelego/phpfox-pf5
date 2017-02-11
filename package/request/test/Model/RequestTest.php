<?php
namespace Neutron\Request\Model;


class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Request([
            'id'           => 4,
            'user_id'      => 2,
            'poster_type'  => 'pages',
            'poster_id'    => 3,
            'about_type'   => 'blog_post',
            'about_id'     => 33,
            'type_id'      => 'comment_add',
            'params'       => '[]',
            'is_read'      => 0,
            'is_mitigated' => 0,
            'created_at'   => '2017-12-00 11:12:09',
        ]);

        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(3, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(33, $obj->getAboutId());
        $this->assertSame('comment_add', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(0, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2017-12-00 11:12:09', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Request();

        // set data
        $obj->setId(4);
        $obj->setUserId(2);
        $obj->setPosterType('pages');
        $obj->setPosterId(3);
        $obj->setAboutType('blog_post');
        $obj->setAboutId(33);
        $obj->setTypeId('comment_add');
        $obj->setParams('[]');
        $obj->setRead(0);
        $obj->setMitigated(0);
        $obj->setCreatedAt('2017-12-00 11:12:09');

        // assert same data
        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(3, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(33, $obj->getAboutId());
        $this->assertSame('comment_add', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(0, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2017-12-00 11:12:09', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Request([
            'id'           => 4,
            'user_id'      => 2,
            'poster_type'  => 'pages',
            'poster_id'    => 3,
            'about_type'   => 'blog_post',
            'about_id'     => 33,
            'type_id'      => 'comment_add',
            'params'       => '[]',
            'is_read'      => 0,
            'is_mitigated' => 0,
            'created_at'   => '2017-12-00 11:12:09',
        ]);

        $obj->save();

        /** @var Request $obj */
        $obj = \Phpfox::with('request')
            ->select()
            ->where('id=?', 4)
            ->first();

        $this->assertSame('request', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('pages', $obj->getPosterType());
        $this->assertSame(3, $obj->getPosterId());
        $this->assertSame('blog_post', $obj->getAboutType());
        $this->assertSame(33, $obj->getAboutId());
        $this->assertSame('comment_add', $obj->getTypeId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(0, $obj->isRead());
        $this->assertSame(0, $obj->isMitigated());
        $this->assertSame('2017-12-00 11:12:09', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('request')
            ->delete()
            ->where('id=?', 4)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('request')
            ->delete()
            ->where('id=?', 4)
            ->execute();
    }
}