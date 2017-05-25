<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileType extends DbModel
{
    public function getModelId(){return 'profile_type';}

    public function getInternalId(){return (int) $this->__get('internal_id');}
    public function getId(){return (int) $this->__get('internal_id');}
    public function setInternalId($value){$this->__set('internal_id', $value);}
    public function setId($value){$this->__set('internal_id', $value);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function getCatalogId(){return (int) $this->__get('catalog_id');}
    public function setCatalogId($value){$this->__set('catalog_id', $value);}
    }