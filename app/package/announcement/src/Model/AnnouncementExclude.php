<?php

namespace Neutron\Announcement\Model;

use Phpfox\Db\DbModel;

class AnnouncementExclude extends DbModel
{
    public function getModelId()
    {
        return 'announcement_exclude';
    }

    public function getId()
    {
        return (int)$this->__get('exclude_id');
    }

    public function setId($value)
    {
        $this->__set('exclude_id', $value);
    }

    public function getAnnouncementId()
    {
        return (int)$this->__get('announcement_id');
    }

    public function setAnnouncementId($value)
    {
        $this->__set('announcement_id', $value);
    }

    public function getExcludeType()
    {
        return $this->__get('exclude_type');
    }

    public function setExcludeType($value)
    {
        $this->__set('exclude_type', $value);
    }

    public function getExcludeValue()
    {
        return (int)$this->__get('exclude_value');
    }

    public function setExcludeValue($value)
    {
        $this->__set('exclude_value', $value);
    }

}