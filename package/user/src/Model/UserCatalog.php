<?php
namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class UserCatalog extends DbModel
{
    public function getModelId(){return 'user_catalog';}

    public function getCatalogId(){return (int) $this->__get('catalog_id');}
    public function getId(){return (int) $this->__get('catalog_id');}
    public function setCatalogId($value){$this->__set('catalog_id', $value);}
    public function setId($value){$this->__set('catalog_id', $value);}
    
    public function getCatalogName(){return $this->__get('catalog_name');}
    public function setCatalogName($value){$this->__set('catalog_name', $value);}
    
    public function getCatalogLabel(){return $this->__get('catalog_label');}
    public function setCatalogLabel($value){$this->__set('catalog_label', $value);}
    
    public function getCatalogDescription(){return $this->__get('catalog_description');}
    public function setCatalogDescription($value){$this->__set('catalog_description', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isSystem(){return $this->__get('is_system') ?1:0;}
    public function setSystem($value){$this->__set('is_system',$value?1:0);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    }