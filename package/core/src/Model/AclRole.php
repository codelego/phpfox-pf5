<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclRole extends DbModel
{
    public function getModelId(){return 'acl_role';}

    public function getId(){return (int) $this->__get('role_id');}
    public function setId($value){$this->__set('role_id', $value);}
    
    public function getInheritId(){return (int) $this->__get('inherit_id');}
    public function setInheritId($value){$this->__set('inherit_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getItemCount(){return (int) $this->__get('item_count');}
    public function setItemCount($value){$this->__set('item_count', $value);}
    
    public function isSpecial(){return $this->__get('is_special') ?1:0;}
    public function setSpecial($value){$this->__set('is_special',$value?1:0);}
    
    public function isSuper(){return $this->__get('is_super') ?1:0;}
    public function setSuper($value){$this->__set('is_super',$value?1:0);}
    
    public function isAdmin(){return $this->__get('is_admin') ?1:0;}
    public function setAdmin($value){$this->__set('is_admin',$value?1:0);}
    
    public function isModerator(){return $this->__get('is_moderator') ?1:0;}
    public function setModerator($value){$this->__set('is_moderator',$value?1:0);}
    
    public function isStaff(){return $this->__get('is_staff') ?1:0;}
    public function setStaff($value){$this->__set('is_staff',$value?1:0);}
    
    public function isRegistered(){return $this->__get('is_registered') ?1:0;}
    public function setRegistered($value){$this->__set('is_registered',$value?1:0);}
    
    public function isBanned(){return $this->__get('is_banned') ?1:0;}
    public function setBanned($value){$this->__set('is_banned',$value?1:0);}
    
    public function isGuest(){return $this->__get('is_guest') ?1:0;}
    public function setGuest($value){$this->__set('is_guest',$value?1:0);}
    
}