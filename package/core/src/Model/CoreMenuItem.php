<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreMenuItem extends DbModel
{
    public function getModelId(){return 'core_menu_item';}

    public function getId(){return (int) $this->__get('id');}
    public function setId($value){$this->__set('id', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function getMenuId(){return $this->__get('menu_id');}
    public function setMenuId($value){$this->__set('menu_id', $value);}
    
    public function getName(){return $this->__get('name');}
    public function setName($value){$this->__set('name', $value);}
    
    public function getParentName(){return $this->__get('parent_name');}
    public function setParentName($value){$this->__set('parent_name', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getLabel(){return $this->__get('label');}
    public function setLabel($value){$this->__set('label', $value);}
    
    public function getHref(){return $this->__get('href');}
    public function setHref($value){$this->__set('href', $value);}
    
    public function getRoute(){return $this->__get('route');}
    public function setRoute($value){$this->__set('route', $value);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    
    public function getExtra(){return $this->__get('extra');}
    public function setExtra($value){$this->__set('extra', $value);}
    
    public function getPermission(){return $this->__get('permission');}
    public function setPermission($value){$this->__set('permission', $value);}
    
    public function getEvent(){return $this->__get('event');}
    public function setEvent($value){$this->__set('event', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isCustom(){return $this->__get('is_custom') ?1:0;}
    public function setCustom($value){$this->__set('is_custom',$value?1:0);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function isAjax(){return $this->__get('is_ajax') ?1:0;}
    public function setAjax($value){$this->__set('is_ajax',$value?1:0);}
    
    public function isSelf(){return $this->__get('is_self') ?1:0;}
    public function setSelf($value){$this->__set('is_self',$value?1:0);}
    }