<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutElement extends DbModel
{
    public function getModelId(){return 'layout_element';}

    public function getId(){return (int) $this->__get('id');}
    public function setId($value){$this->__set('id', $value);}
    
    public function getPageId(){return $this->__get('page_id');}
    public function setPageId($value){$this->__set('page_id', $value);}
    
    public function getThemeId(){return $this->__get('theme_id');}
    public function setThemeId($value){$this->__set('theme_id', $value);}
    
    public function getBlockId(){return $this->__get('block_id');}
    public function setBlockId($value){$this->__set('block_id', $value);}
    
    public function getLocationId(){return $this->__get('location_id');}
    public function setLocationId($value){$this->__set('location_id', $value);}
    
    public function getSortOrder(){return (int) $this->__get('sort_order');}
    public function setSortOrder($value){$this->__set('sort_order', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    
}