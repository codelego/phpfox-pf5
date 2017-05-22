<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileProcess extends DbModel
{
    public function getModelId(){return 'profile_process';}

    public function getProcessId(){return $this->__get('process_id');}
    public function getId(){return $this->__get('process_id');}
    public function setProcessId($value){$this->__set('process_id', $value);}
    public function setId($value){$this->__set('process_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    }