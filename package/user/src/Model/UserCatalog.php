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
    
    public function getName(){return $this->__get('name');}
    public function setName($value){$this->__set('name', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isCore(){return $this->__get('is_core') ?1:0;}
    public function setCore($value){$this->__set('is_core',$value?1:0);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    }