<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclPermAllow extends DbModel
{
    public function getModelId(){return 'acl_perm_allow';}

    public function getId(){return (int) $this->__get('id');}
    public function setId($value){$this->__set('id', $value);}
    
    public function getResourceType(){return $this->__get('resource_type');}
    public function setResourceType($value){$this->__set('resource_type', $value);}
    
    public function getResourceId(){return (int) $this->__get('resource_id');}
    public function setResourceId($value){$this->__set('resource_id', $value);}
    
    public function getRoleId(){return $this->__get('role_id');}
    public function setRoleId($value){$this->__set('role_id', $value);}
    
    public function getActionId(){return $this->__get('action_id');}
    public function setActionId($value){$this->__set('action_id', $value);}
    
    public function getValueId(){return (int) $this->__get('value_id');}
    public function setValueId($value){$this->__set('value_id', $value);}
    }