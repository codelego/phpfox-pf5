<?php
namespace Neutron\Pages\Model;

use Phpfox\Db\DbModel;

class PagesLevel extends DbModel
{
    public function getModelId(){return 'pages_level';}

    public function getLevelId(){return (int) $this->__get('level_id');}
    public function getId(){return (int) $this->__get('level_id');}
    public function setLevelId($value){$this->__set('level_id', $value);}
    public function setId($value){$this->__set('level_id', $value);}
    
    public function getInheritId(){return (int) $this->__get('inherit_id');}
    public function setInheritId($value){$this->__set('inherit_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getItemCount(){return (int) $this->__get('item_count');}
    public function setItemCount($value){$this->__set('item_count', $value);}
    
    public function isCore(){return $this->__get('is_core') ?1:0;}
    public function setCore($value){$this->__set('is_core',$value?1:0);}
    }