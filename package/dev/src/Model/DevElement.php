<?php
namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;

class DevElement extends DbModel
{
    public function getModelId(){return 'dev_element';}

    public function getElementId(){return (int) $this->__get('element_id');}
    public function getId(){return (int) $this->__get('element_id');}
    public function setElementId($value){$this->__set('element_id', $value);}
    public function setId($value){$this->__set('element_id', $value);}
    
    public function getMetaId(){return (int) $this->__get('meta_id');}
    public function setMetaId($value){$this->__set('meta_id', $value);}
    
    public function getElementName(){return $this->__get('element_name');}
    public function setElementName($value){$this->__set('element_name', $value);}
    
    public function getFactoryId(){return $this->__get('factory_id');}
    public function setFactoryId($value){$this->__set('factory_id', $value);}
    
    public function getLabel(){return $this->__get('label');}
    public function setLabel($value){$this->__set('label', $value);}
    
    public function getSortOrder(){return (int) $this->__get('sort_order');}
    public function setSortOrder($value){$this->__set('sort_order', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getNote(){return $this->__get('note');}
    public function setNote($value){$this->__set('note', $value);}
    
    public function getInfo(){return $this->__get('info');}
    public function setInfo($value){$this->__set('info', $value);}
    }