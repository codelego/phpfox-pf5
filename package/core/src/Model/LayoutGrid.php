<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutGrid extends DbModel
{
    public function getModelId(){return 'layout_grid';}

    public function getId(){return $this->__get('grid_id');}
    public function setId($value){$this->__set('grid_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getSortOrder(){return (int) $this->__get('sort_order');}
    public function setSortOrder($value){$this->__set('sort_order', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
}