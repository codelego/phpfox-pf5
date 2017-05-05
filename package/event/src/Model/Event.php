<?php

namespace Neutron\Events\Model;

use Phpfox\Db\DbModel;

class Event extends DbModel
{
    public function getModelId(){return '';}

    public function getId(){return (int) $this->__get('event_id');}
    public function setId($value){$this->__set('event_id', $value);}
    
    public function isFeatured(){return $this->__get('is_featured') ?1:0;}
    public function setFeatured($value){$this->__set('is_featured',$value?1:0);}
    
    public function isSponsor(){return $this->__get('is_sponsor') ?1:0;}
    public function setSponsor($value){$this->__set('is_sponsor',$value?1:0);}
    
    public function getPrivacyId(){return (int) $this->__get('privacy_id');}
    public function setPrivacyId($value){$this->__set('privacy_id', $value);}
    
    public function getParentId(){return (int) $this->__get('parent_id');}
    public function setParentId($value){$this->__set('parent_id', $value);}
    
    public function getPosterId(){return (int) $this->__get('poster_id');}
    public function setPosterId($value){$this->__set('poster_id', $value);}
    
    public function getUserId(){return (int) $this->__get('user_id');}
    public function setUserId($value){$this->__set('user_id', $value);}
    
    public function getLocationId(){return (int) $this->__get('location_id');}
    public function setLocationId($value){$this->__set('location_id', $value);}
    
    public function getPhotoId(){return (int) $this->__get('photo_id');}
    public function setPhotoId($value){$this->__set('photo_id', $value);}
    
    public function getStartAt(){return $this->__get('start_at');}
    public function setStartAt($value){$this->__set('start_at', $value);}
    
    public function getEndAt(){return $this->__get('end_at');}
    public function setEndAt($value){$this->__set('end_at', $value);}
    
    public function getCreatedAt(){return $this->__get('created_at');}
    public function setCreatedAt($value){$this->__set('created_at', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getPosterType(){return $this->__get('poster_type');}
    public function setPosterType($value){$this->__set('poster_type', $value);}
    
    public function getParentType(){return $this->__get('parent_type');}
    public function setParentType($value){$this->__set('parent_type', $value);}
    
}