<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class ThemeParams extends DbModel
{
    public function getModelId(){return 'theme_params';}

    public function getId(){return (int) $this->__get('params_id');}
    public function setId($value){$this->__set('params_id', $value);}
    
    public function getThemeId(){return $this->__get('theme_id');}
    public function setThemeId($value){$this->__set('theme_id', $value);}
    
    public function getParams(){return $this->__get('params');}
    public function setParams($value){$this->__set('params', $value);}
    
}