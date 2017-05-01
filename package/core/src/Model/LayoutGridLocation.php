<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutGridLocation extends DbModel
{
    public function getModelId(){return 'layout_grid_location';}

    public function getId(){return $this->__get('grid_id');}
    public function setId($value){$this->__set('grid_id', $value);}
    
    public function getLocationId(){return $this->__get('location_id');}
    public function setLocationId($value){$this->__set('location_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getSortOrder(){return (int) $this->__get('sort_order');}
    public function setSortOrder($value){$this->__set('sort_order', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
}