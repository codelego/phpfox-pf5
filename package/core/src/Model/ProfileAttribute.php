<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileAttribute extends DbModel
{
    public function getModelId(){return 'profile_attribute';}

    public function getAttributeId(){return (int) $this->__get('attribute_id');}
    public function getId(){return (int) $this->__get('attribute_id');}
    public function setAttributeId($value){$this->__set('attribute_id', $value);}
    public function setId($value){$this->__set('attribute_id', $value);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function getAttributeName(){return $this->__get('attribute_name');}
    public function setAttributeName($value){$this->__set('attribute_name', $value);}
    
    public function getAttributeType(){return $this->__get('attribute_type');}
    public function setAttributeType($value){$this->__set('attribute_type', $value);}
    
    public function getAttributeLabel(){return $this->__get('attribute_label');}
    public function setAttributeLabel($value){$this->__set('attribute_label', $value);}
    
    public function isBasic(){return $this->__get('is_basic') ?1:0;}
    public function setBasic($value){$this->__set('is_basic',$value?1:0);}
    
    public function isRequire(){return $this->__get('is_require') ?1:0;}
    public function setRequire($value){$this->__set('is_require',$value?1:0);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function getAttributeOptions(){return $this->__get('attribute_options');}
    public function setAttributeOptions($value){$this->__set('attribute_options', $value);}
    
    public function isSystem(){return $this->__get('is_system') ?1:0;}
    public function setSystem($value){$this->__set('is_system',$value?1:0);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    }