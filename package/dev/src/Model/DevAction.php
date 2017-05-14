<?php
namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;

class DevAction extends DbModel
{
    public function getModelId(){return 'dev_action';}

    public function getMetaId(){return (int) $this->__get('meta_id');}
    public function getId(){return (int) $this->__get('meta_id');}
    public function setMetaId($value){$this->__set('meta_id', $value);}
    public function setId($value){$this->__set('meta_id', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getTableName(){return $this->__get('table_name');}
    public function setTableName($value){$this->__set('table_name', $value);}
    
    public function getActionType(){return $this->__get('action_type');}
    public function setActionType($value){$this->__set('action_type', $value);}
    
    public function getActionId(){return $this->__get('action_id');}
    public function setActionId($value){$this->__set('action_id', $value);}
    
    public function getTextDomain(){return $this->__get('text_domain');}
    public function setTextDomain($value){$this->__set('text_domain', $value);}
    
    public function getFormTitle(){return $this->__get('form_title');}
    public function setFormTitle($value){$this->__set('form_title', $value);}
    
    public function getFormInfo(){return $this->__get('form_info');}
    public function setFormInfo($value){$this->__set('form_info', $value);}
    }