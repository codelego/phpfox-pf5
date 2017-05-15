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
    
    public function getDataSubmit(){return $this->__get('data_submit');}
    public function setDataSubmit($value){$this->__set('data_submit', $value);}
    
    public function getCancelUrl(){return $this->__get('cancel_url');}
    public function setCancelUrl($value){$this->__set('cancel_url', $value);}
    
    public function getActionUrl(){return $this->__get('action_url');}
    public function setActionUrl($value){$this->__set('action_url', $value);}
    
    public function getTitleDomain(){return $this->__get('title_domain');}
    public function setTitleDomain($value){$this->__set('title_domain', $value);}
    
    public function getInfoDomain(){return $this->__get('info_domain');}
    public function setInfoDomain($value){$this->__set('info_domain', $value);}
    
    public function getSubmitLabel(){return $this->__get('submit_label');}
    public function setSubmitLabel($value){$this->__set('submit_label', $value);}
    
    public function getFormEnctype(){return $this->__get('form_enctype');}
    public function setFormEnctype($value){$this->__set('form_enctype', $value);}
    
    public function getFormMethod(){return $this->__get('form_method');}
    public function setFormMethod($value){$this->__set('form_method', $value);}
    }