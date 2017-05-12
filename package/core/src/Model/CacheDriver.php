<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CacheDriver extends DbModel
{
    public function getModelId(){return 'cache_driver';}

    public function getDriverId(){return $this->__get('driver_id');}
    public function getId(){return $this->__get('driver_id');}
    public function setDriverId($value){$this->__set('driver_id', $value);}
    public function setId($value){$this->__set('driver_id', $value);}
    
    public function getDriverName(){return $this->__get('driver_name');}
    public function setDriverName($value){$this->__set('driver_name', $value);}
    
    public function getFormName(){return $this->__get('form_name');}
    public function setFormName($value){$this->__set('form_name', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    }