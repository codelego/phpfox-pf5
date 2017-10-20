<?php
namespace Neutron\Video\Model;

class VideoTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Video(array (  'video_id' => 14,  'is_active' => 1,  'is_approval' => 1,  'channel_id' => 0,  'category_id' => 4,  'provider_id' => '[youtube]',  'title' => '[title]',  'user_id' => 44,  'parent_id' => 45,  'parent_type' => 'pages',  'poster_id' => 434,  'poster_type' => 'user',  'description' => '[description]',  'created_at' => '0000-00-00 00:00:00',  'updated_at' => '0000-00-00 00:00:00',  'params' => '[]',));

        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(14, $obj->getVideoId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(0, $obj->getChannelId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('[]', $obj->getParams());    }

    public function testParameters()
    {
        $obj = new Video();

        // set data
        $obj->setVideoId(14);
        $obj->setActive(1);
        $obj->setApproval(1);
        $obj->setChannelId(0);
        $obj->setCategoryId(4);
        $obj->setProviderId('[youtube]');
        $obj->setTitle('[title]');
        $obj->setUserId(44);
        $obj->setParentId(45);
        $obj->setParentType('pages');
        $obj->setPosterId(434);
        $obj->setPosterType('user');
        $obj->setDescription('[description]');
        $obj->setCreatedAt('0000-00-00 00:00:00');
        $obj->setUpdatedAt('0000-00-00 00:00:00');
        $obj->setParams('[]');
        // assert same data
        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(14, $obj->getVideoId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(0, $obj->getChannelId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('[]', $obj->getParams());    }

    public function testSave()
    {
        $obj = new Video(array (  'video_id' => 14,  'is_active' => 1,  'is_approval' => 1,  'channel_id' => 0,  'category_id' => 4,  'provider_id' => '[youtube]',  'title' => '[title]',  'user_id' => 44,  'parent_id' => 45,  'parent_type' => 'pages',  'poster_id' => 434,  'poster_type' => 'user',  'description' => '[description]',  'created_at' => '0000-00-00 00:00:00',  'updated_at' => '0000-00-00 00:00:00',  'params' => '[]',));

        $obj->save();

        /** @var Video $obj */
        $obj = _model('video')
            ->select()->where('video_id=?',14)->first();

        $this->assertSame('video', $obj->getModelId());
        $this->assertSame(14, $obj->getVideoId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(0, $obj->getChannelId());
        $this->assertSame(4, $obj->getCategoryId());
        $this->assertSame('[youtube]', $obj->getProviderId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(45, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(434, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
        $this->assertSame('0000-00-00 00:00:00', $obj->getUpdatedAt());
        $this->assertSame('[]', $obj->getParams());    }

    public static function setUpBeforeClass()
    {
        _model('video')
            ->delete()->where('video_id=?',14)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('video')
            ->delete()->where('video_id=?',14)->execute();
    }
}