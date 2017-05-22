<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileQuestion extends DbModel
{
    public function getModelId(){return 'profile_question';}

    public function getQuestionId(){return (int) $this->__get('question_id');}
    public function getId(){return (int) $this->__get('question_id');}
    public function setQuestionId($value){$this->__set('question_id', $value);}
    public function setId($value){$this->__set('question_id', $value);}
    
    public function getInternalId(){return (int) $this->__get('internal_id');}
    public function setInternalId($value){$this->__set('internal_id', $value);}
    
    public function getItemType(){return $this->__get('item_type');}
    public function setItemType($value){$this->__set('item_type', $value);}
    
    public function getQuestionName(){return $this->__get('question_name');}
    public function setQuestionName($value){$this->__set('question_name', $value);}
    
    public function getFactoryId(){return $this->__get('factory_id');}
    public function setFactoryId($value){$this->__set('factory_id', $value);}
    
    public function getQuestionLabel(){return $this->__get('question_label');}
    public function setQuestionLabel($value){$this->__set('question_label', $value);}
    
    public function getPlaceholder(){return $this->__get('placeholder');}
    public function setPlaceholder($value){$this->__set('placeholder', $value);}
    
    public function getInfo(){return $this->__get('info');}
    public function setInfo($value){$this->__set('info', $value);}
    
    public function getNote(){return $this->__get('note');}
    public function setNote($value){$this->__set('note', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isRequire(){return $this->__get('is_require') ?1:0;}
    public function setRequire($value){$this->__set('is_require',$value?1:0);}
    
    public function getOrdering(){return (int) $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function getOptions(){return $this->__get('options');}
    public function setOptions($value){$this->__set('options', $value);}
    }