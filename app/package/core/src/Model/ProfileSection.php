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
    
    public function getProcessId(){return (int) $this->__get('process_id');}
    public function setProcessId($value){$this->__set('process_id', $value);}
    
    public function getSectionLabel(){return $this->__get('section_label');}
    public function setSectionLabel($value){$this->__set('section_label', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getDependencies(){return $this->__get('dependencies');}
    public function setDependencies($value){$this->__set('dependencies', $value);}
    }