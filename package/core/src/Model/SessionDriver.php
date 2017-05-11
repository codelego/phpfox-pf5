<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class SessionDriver extends DbModel
{
    public function getModelId(){return 'session_driver';}

    public function getDriverId(){return $this->__get('driver_id');}
    public function getId(){return $this->__get('driver_id');}
    public function setDriverId($value){$this->__set('driver_id', $value);}
    public function setId($value){$this->__set('driver_id', $value);}
    
    public function getDriverName(){return $this->__get('driver_name');}
    public function setDriverName($value){$this->__set('driver_name', $value);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    
    public function isDefault(){return $this->__get('is_default') ?1:0;}
    public function setDefault($value){$this->__set('is_default',$value?1:0);}
    
    public function getFormName(){return $this->__get('form_name');}
    public function setFormName($value){$this->__set('form_name', $value);}
    
    public function getDriverClass(){return $this->__get('driver_class');}
    public function setDriverClass($value){$this->__set('driver_class', $value);}
    }