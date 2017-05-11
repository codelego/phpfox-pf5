<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutPage extends DbModel
{
    public function getModelId(){return 'layout_page';}

    public function getPageId(){return (int) $this->__get('page_id');}
    public function getId(){return (int) $this->__get('page_id');}
    public function setPageId($value){$this->__set('page_id', $value);}
    public function setId($value){$this->__set('page_id', $value);}
    
    public function getActionId(){return $this->__get('action_id');}
    public function setActionId($value){$this->__set('action_id', $value);}
    
    public function getThemeId(){return $this->__get('theme_id');}
    public function setThemeId($value){$this->__set('theme_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    }