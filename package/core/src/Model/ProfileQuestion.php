<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ProfileQuestion extends DbModel
{
    public function getModelId(){return 'profile_question';}

    public function getQuestionId(){return $this->__get('question_id');}
    public function getId(){return $this->__get('question_id');}
    public function setQuestionId($value){$this->__set('question_id', $value);}
    public function setId($value){$this->__set('question_id', $value);}
    
    public function getSectionId(){return $this->__get('section_id');}
    public function setSectionId($value){$this->__set('section_id', $value);}
    
    public function getAttributeId(){return $this->__get('attribute_id');}
    public function setAttributeId($value){$this->__set('attribute_id', $value);}
    
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
    
    public function getOrdering(){return $this->__get('ordering');}
    public function setOrdering($value){$this->__set('ordering', $value);}
    
    public function getOptions(){return $this->__get('options');}
    public function setOptions($value){$this->__set('options', $value);}
    
    public function getDependencies(){return $this->__get('dependencies');}
    public function setDependencies($value){$this->__set('dependencies', $value);}
    }