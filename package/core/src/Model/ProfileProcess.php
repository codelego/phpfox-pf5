<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileProcess extends DbModel
{
    public function getModelId(){return 'profile_process';}

    public function getProcessId(){return (int) $this->__get('process_id');}
    public function getId(){return (int) $this->__get('process_id');}
    public function setProcessId($value){$this->__set('process_id', $value);}
    public function setId($value){$this->__set('process_id', $value);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function getProcessType(){return $this->__get('process_type');}
    public function setProcessType($value){$this->__set('process_type', $value);}
    
    public function getCatalogId(){return (int) $this->__get('catalog_id');}
    public function setCatalogId($value){$this->__set('catalog_id', $value);}
    }