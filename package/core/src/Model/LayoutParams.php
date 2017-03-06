<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutParams extends DbModel
{
    public function getModelId(){return 'layout_params';}

    public function getId(){return (int) $this->__get('id');}
    public function setId($value){$this->__set('id', $value);}
    
    public function getPageId(){return $this->__get('page_id');}
    public function setPageId($value){$this->__set('page_id', $value);}
    
    public function getThemeId(){return $this->__get('theme_id');}
    public function setThemeId($value){$this->__set('theme_id', $value);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    
}