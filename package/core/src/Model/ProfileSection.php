<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileSection extends DbModel
{
    public function getModelId(){return 'profile_section';}

    public function getSectionId(){return (int) $this->__get('section_id');}
    public function getId(){return (int) $this->__get('section_id');}
    public function setSectionId($value){$this->__set('section_id', $value);}
    public function setId($value){$this->__set('section_id', $value);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function getSectionName(){return $this->__get('section_name');}
    public function setSectionName($value){$this->__set('section_name', $value);}
    
    public function getSectionLabel(){return $this->__get('section_label');}
    public function setSectionLabel($value){$this->__set('section_label', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    }