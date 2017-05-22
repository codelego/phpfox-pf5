<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileStep extends DbModel
{
    public function getModelId(){return 'profile_step';}

    public function getStepId(){return (int) $this->__get('step_id');}
    public function getId(){return (int) $this->__get('step_id');}
    public function setStepId($value){$this->__set('step_id', $value);}
    public function setId($value){$this->__set('step_id', $value);}
    
    public function getProcessId(){return $this->__get('process_id');}
    public function setProcessId($value){$this->__set('process_id', $value);}
    
    public function getFormName(){return $this->__get('form_name');}
    public function setFormName($value){$this->__set('form_name', $value);}
    
    public function getStepName(){return $this->__get('step_name');}
    public function setStepName($value){$this->__set('step_name', $value);}
    
    public function getFormStepName(){return $this->__get('form_step_name');}
    public function setFormStepName($value){$this->__set('form_step_name', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isRequire(){return $this->__get('is_require') ?1:0;}
    public function setRequire($value){$this->__set('is_require',$value?1:0);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    }