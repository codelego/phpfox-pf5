<?php

namespace Neutron\Messages\Model;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Messages([
            'message_id'      => 2,
            'conversation_id' => 4,
            'user_id'         => 23,
            'title'           => 'title',
            'content'         => 'body',
            'created_at'      => '2016-01-12 00:00:00',
            'attachment_type' => 'blog_post',
            'attachment_id'   => 12,
        ]);

        $this->assertSame('messages', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getConversationId());
        $this->assertSame(23, $obj->getUserId());
        $this->assertSame('title', $obj->getTitle());
        $this->assertSame('body', $obj->getContent());
        $this->assertSame('2016-01-12 00:00:00', $obj->getCreatedAt());
        $this->assertSame('blog_post', $obj->getAttachmentType());
        $this->assertSame(12, $obj->getAttachmentId());
    }

    public function testParameters()
    {
        $obj = new Messages();

        // set data
        $obj->setId(2);
        $obj->setConversationId(4);
        $obj->setUserId(23);
        $obj->setTitle('title');
        $obj->setContent('body');
        $obj->setCreatedAt('2016-01-12 00:00:00');
        $obj->setAttachmentType('blog_post');
        $obj->setAttachmentId(12);

        // assert same data
        $this->assertSame('messages', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getConversationId());
        $this->assertSame(23, $obj->getUserId());
        $this->assertSame('title', $obj->getTitle());
        $this->assertSame('body', $obj->getContent());
        $this->assertSame('2016-01-12 00:00:00', $obj->getCreatedAt());
        $this->assertSame('blog_post', $obj->getAttachmentType());
        $this->assertSame(12, $obj->getAttachmentId());
    }

    public function testSave()
    {
        $obj = new Messages([
            'message_id'      => 2,
            'conversation_id' => 4,
            'user_id'         => 23,
            'title'           => 'title',
            'content'         => 'body',
            'created_at'      => '2016-01-12 00:00:00',
            'attachment_type' => 'blog_post',
            'attachment_id'   => 12,
        ]);

        $obj->save();

        /** @var Messages $obj */
        $obj = \Phpfox::with('messages')
            ->select()->where('message_id=?', 2)->first();

        $this->assertSame('messages', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getConversationId());
        $this->assertSame(23, $obj->getUserId());
        $this->assertSame('title', $obj->getTitle());
        $this->assertSame('body', $obj->getContent());
        $this->assertSame('2016-01-12 00:00:00', $obj->getCreatedAt());
        $this->assertSame('blog_post', $obj->getAttachmentType());
        $this->assertSame(12, $obj->getAttachmentId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('messages')
            ->delete()->where('message_id=?', 2)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('messages')
            ->delete()->where('message_id=?', 2)->execute();
    }
}