<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutBlock extends DbModel
{
    public function getModelId(){return 'layout_block';}

    public function getId(){return $this->__get('block_id');}
    public function setId($value){$this->__set('block_id', $value);}
    
    public function getBlockName(){return $this->__get('block_name');}
    public function setBlockName($value){$this->__set('block_name', $value);}
    
    public function getFormClass(){return $this->__get('form_class');}
    public function setFormClass($value){$this->__set('form_class', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
}