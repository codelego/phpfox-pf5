<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclLevel extends DbModel
{
    public function getModelId(){return 'acl_level';}

    public function getInternalId(){return (int) $this->__get('internal_id');}
    public function getId(){return (int) $this->__get('internal_id');}
    public function setInternalId($value){$this->__set('internal_id', $value);}
    public function setId($value){$this->__set('internal_id', $value);}
    
    public function getLevelId(){return (int) $this->__get('level_id');}
    public function setLevelId($value){$this->__set('level_id', $value);}
    
    public function getLevelType(){return $this->__get('level_type');}
    public function setLevelType($value){$this->__set('level_type', $value);}
    
    public function getInheritId(){return (int) $this->__get('inherit_id');}
    public function setInheritId($value){$this->__set('inherit_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    }