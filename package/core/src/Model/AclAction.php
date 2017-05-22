<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclAction extends DbModel
{
    public function getModelId(){return 'acl_action';}

    public function getActionId(){return (int) $this->__get('action_id');}
    public function getId(){return (int) $this->__get('action_id');}
    public function setActionId($value){$this->__set('action_id', $value);}
    public function setId($value){$this->__set('action_id', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getDomainId(){return $this->__get('domain_id');}
    public function setDomainId($value){$this->__set('domain_id', $value);}
    
    public function getFormId(){return $this->__get('form_id');}
    public function setFormId($value){$this->__set('form_id', $value);}
    
    public function getName(){return $this->__get('name');}
    public function setName($value){$this->__set('name', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    }