<?php

namespace Neutron\Messages\Model;

use Phpfox\Db\DbModel;

class Messages extends DbModel
{
    public function getModelId()
    {
        return 'messages';
    }

    public function getId()
    {
        return (int)$this->__get('message_id');
    }

    public function setId($value)
    {
        $this->__set('message_id', $value);
    }

    public function getConversationId()
    {
        return (int)$this->__get('conversation_id');
    }

    public function setConversationId($value)
    {
        $this->__set('conversation_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getContent()
    {
        return $this->__get('content');
    }

    public function setContent($value)
    {
        $this->__set('content', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    public function getAttachmentType()
    {
        return $this->__get('attachment_type');
    }

    public function setAttachmentType($value)
    {
        $this->__set('attachment_type', $value);
    }

    public function getAttachmentId()
    {
        return (int)$this->__get('attachment_id');
    }

    public function setAttachmentId($value)
    {
        $this->__set('attachment_id', $value);
    }

}