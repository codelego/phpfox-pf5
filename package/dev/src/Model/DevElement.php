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
    
    public function isIdentity(){return $this->__get('is_identity') ?1:0;}
    public function setIdentity($value){$this->__set('is_identity',$value?1:0);}
    
    public function isPrimary(){return $this->__get('is_primary') ?1:0;}
    public function setPrimary($value){$this->__set('is_primary',$value?1:0);}
    
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
    
    public function getDefaultValue(){return $this->__get('default_value');}
    public function setDefaultValue($value){$this->__set('default_value', $value);}
    
    public function getNote(){return $this->__get('note');}
    public function setNote($value){$this->__set('note', $value);}
    
    public function getInfo(){return $this->__get('info');}
    public function setInfo($value){$this->__set('info', $value);}
    
    public function getPlaceholder(){return $this->__get('placeholder');}
    public function setPlaceholder($value){$this->__set('placeholder', $value);}
    
    public function getMaxLength(){return $this->__get('max_length');}
    public function setMaxLength($value){$this->__set('max_length', $value);}
    
    public function getRows(){return $this->__get('rows');}
    public function setRows($value){$this->__set('rows', $value);}
    
    public function getCols(){return $this->__get('cols');}
    public function setCols($value){$this->__set('cols', $value);}
    
    public function isRequire(){return $this->__get('is_require') ?1:0;}
    public function setRequire($value){$this->__set('is_require',$value?1:0);}
    
    public function isReadonly(){return $this->__get('is_readonly') ?1:0;}
    public function setReadonly($value){$this->__set('is_readonly',$value?1:0);}
    
    public function isDisabled(){return $this->__get('is_disabled') ?1:0;}
    public function setDisabled($value){$this->__set('is_disabled',$value?1:0);}
    
    public function getClassName(){return $this->__get('class_name');}
    public function setClassName($value){$this->__set('class_name', $value);}
    
    public function getDataCmd(){return $this->__get('data_cmd');}
    public function setDataCmd($value){$this->__set('data_cmd', $value);}
    
    public function getPrimaryLength(){return (int) $this->__get('primary_length');}
    public function setPrimaryLength($value){$this->__set('primary_length', $value);}
    
    public function getOptionsText(){return $this->__get('options_text');}
    public function setOptionsText($value){$this->__set('options_text', $value);}
    }