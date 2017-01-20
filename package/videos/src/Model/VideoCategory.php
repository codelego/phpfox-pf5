<?php
namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class VideoCategory extends DbModel
{
    public function getModelId()
    {
        return 'video_category';
    }

    public function getId()
    {
        return $this->__get('category_id');
    }

    public function getName()
    {
        return $this->__get('category_name');
    }

    public function getTitle()
    {
        return $this->__get('category_name');
    }

    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }
}