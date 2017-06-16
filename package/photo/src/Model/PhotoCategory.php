<?php
namespace Neutron\Photo\Model;

use Phpfox\Db\DbModel;

class PhotoCategory extends DbModel
{
    public function getModelId(){return 'photo_category';}

    public function getCategoryId(){return (int) $this->__get('category_id');}
    public function getId(){return (int) $this->__get('category_id');}
    public function setCategoryId($value){$this->__set('category_id', $value);}
    public function setId($value){$this->__set('category_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getName(){return $this->__get('name');}
    public function setName($value){$this->__set('name', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    }