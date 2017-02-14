<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class StorageFile extends DbModel
{
    public function getModelId()
    {
        return 'storage_file';
    }

    public function getId()
    {
        return (int)$this->__get('file_id');
    }

    public function setId($value)
    {
        $this->__set('file_id', $value);
    }

    public function getAdapterId()
    {
        return (int)$this->__get('adapter_id');
    }

    public function setAdapterId($value)
    {
        $this->__set('adapter_id', $value);
    }

    public function getFileSize()
    {
        return (int)$this->__get('file_size');
    }

    public function setFileSize($value)
    {
        $this->__set('file_size', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getFileMime()
    {
        return $this->__get('file_mime');
    }

    public function setFileMime($value)
    {
        $this->__set('file_mime', $value);
    }

    public function getPaths()
    {
        return $this->__get('paths');
    }

    public function setPaths($value)
    {
        $this->__set('paths', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

}