<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutLocation extends DbModel
{
    public function getModelId(){return 'layout_location';}

    public function getId(){return (int) $this->__get('location_id');}
    public function setId($value){$this->__set('location_id', $value);}
    
    public function getContainerId(){return (int) $this->__get('container_id');}
    public function setContainerId($value){$this->__set('container_id', $value);}
    
    public function getPositionId(){return $this->__get('position_id');}
    public function setPositionId($value){$this->__set('position_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getSortOrder(){return (int) $this->__get('sort_order');}
    public function setSortOrder($value){$this->__set('sort_order', $value);}
    
    public function getLocationParams(){return $this->__get('location_params');}
    public function setLocationParams($value){$this->__set('location_params', $value);}
    
}