<?php
namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;

class DevModel extends DbModel
{
    public function getModelId(){return 'dev_model';}

    public function getId(){return (int) $this->__get('id');}
    public function setId($value){$this->__set('id', $value);}
    
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
    
    public function getDataSubmit(){return $this->__get('data_submit');}
    public function setDataSubmit($value){$this->__set('data_submit', $value);}
    
    public function getCancelUrl(){return $this->__get('cancel_url');}
    public function setCancelUrl($value){$this->__set('cancel_url', $value);}
    
    public function getActionUrl(){return $this->__get('action_url');}
    public function setActionUrl($value){$this->__set('action_url', $value);}
    }