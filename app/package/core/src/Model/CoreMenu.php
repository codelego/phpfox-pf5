<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreMenu extends DbModel
{
    public function getModelId(){return 'core_menu';}

    public function getMenuId(){return $this->__get('menu_id');}
    public function getId(){return $this->__get('menu_id');}
    public function setMenuId($value){$this->__set('menu_id', $value);}
    public function setId($value){$this->__set('menu_id', $value);}
    
    public function getMenuName(){return $this->__get('menu_name');}
    public function setMenuName($value){$this->__set('menu_name', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function isAdmin(){return $this->__get('is_admin') ?1:0;}
    public function setAdmin($value){$this->__set('is_admin',$value?1:0);}
    
    public function isSystem(){return $this->__get('is_system') ?1:0;}
    public function setSystem($value){$this->__set('is_system',$value?1:0);}
    
    public function isCustom(){return $this->__get('is_custom') ?1:0;}
    public function setCustom($value){$this->__set('is_custom',$value?1:0);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    }