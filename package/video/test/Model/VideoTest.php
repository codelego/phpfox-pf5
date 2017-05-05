<?php

namespace Neutron\Video\Model;


class VideoTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Video([
            'video_id'    => 14,
            'is_active'   => 1,
            'is_approval' => 1,
            'category_id' => 4,
            'provider_id' => '[youtube]',
            'title'       => '[title]',
            'created_at'  => '2017-01-18 08:56:34',
            'user_id'     => 44,
            'parent_id'   => 45,
            'parent_type' => 'pages',
            'poster_id'   => 434,
            'poster_type' => 'user',
            'description' => '[description]',
        ]);

        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(14, $obj->getId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]',
            $obj->getDescription());
    }

    public function testBase2()
    {
        $obj = new Video([

        ]);

        $obj->setId(14);
        $obj->setActive('1');
        $obj->setApproved(1);
        $obj->setCategoryId(4);
        $obj->setProviderId('[youtube]');
        $obj->setTitle('[title]');
        $obj->setDescription('[description]');
        $obj->setUserId('44]');
        $obj->setPosterId('434');
        $obj->setParentId('45');
        $obj->setPosterType('user');
        $obj->setParentType('pages');
        $obj->setCreatedAt('2017-01-18 08:56:34');

        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(14, $obj->getId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]',
            $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new Video([
            'is_active'   => 1,
            'is_approval' => 1,
            'category_id' => 4,
            'provider_id' => '[youtube]',
            'title'       => '[title]',
            'created_at'  => '2017-01-18 08:56:34',
            'user_id'     => 44,
            'parent_id'   => 45,
            'parent_type' => 'pages',
            'poster_id'   => 434,
            'poster_type' => 'user',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var Video $obj */
        $obj = _model('video')
            ->select()
            ->where('title=?', '[title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->first();

        $this->assertNotNull($obj);

        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('2017-01-18 08:56:34', $obj->getCreatedAt());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]',
            $obj->getDescription());

    }

    public static function tearDownAfterClass()
    {
        _service('db')->delete(':video')
            ->where('title=?', '[title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        _service('db')->delete(':video')
            ->where('title=?', '[title]')
            ->where('created_at=?', '2017-01-18 08:56:34')
            ->where('title=?', '[title]')
            ->execute();
    }

}
