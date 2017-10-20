<?php
namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class Video extends DbModel
{
    public function getModelId(){return 'video';}

    public function getVideoId(){return (int) $this->__get('video_id');}
    public function getId(){return (int) $this->__get('video_id');}
    public function setVideoId($value){$this->__set('video_id', $value);}
    public function setId($value){$this->__set('video_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isApproval(){return $this->__get('is_approval') ?1:0;}
    public function setApproval($value){$this->__set('is_approval',$value?1:0);}
    
    public function getChannelId(){return (int) $this->__get('channel_id');}
    public function setChannelId($value){$this->__set('channel_id', $value);}
    
    public function getCategoryId(){return (int) $this->__get('category_id');}
    public function setCategoryId($value){$this->__set('category_id', $value);}
    
    public function getProviderId(){return $this->__get('provider_id');}
    public function setProviderId($value){$this->__set('provider_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getUserId(){return (int) $this->__get('user_id');}
    public function setUserId($value){$this->__set('user_id', $value);}
    
    public function getParentId(){return (int) $this->__get('parent_id');}
    public function setParentId($value){$this->__set('parent_id', $value);}
    
    public function getParentType(){return $this->__get('parent_type');}
    public function setParentType($value){$this->__set('parent_type', $value);}
    
    public function getPosterId(){return (int) $this->__get('poster_id');}
    public function setPosterId($value){$this->__set('poster_id', $value);}
    
    public function getPosterType(){return $this->__get('poster_type');}
    public function setPosterType($value){$this->__set('poster_type', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
    public function getCreatedAt(){return $this->__get('created_at');}
    public function setCreatedAt($value){$this->__set('created_at', $value);}
    
    public function getUpdatedAt(){return $this->__get('updated_at');}
    public function setUpdatedAt($value){$this->__set('updated_at', $value);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    }