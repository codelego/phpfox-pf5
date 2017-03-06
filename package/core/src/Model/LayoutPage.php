<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutPage extends DbModel
{
    public function getModelId(){return 'layout_page';}

    public function getId(){return $this->__get('page_id');}
    public function setId($value){$this->__set('page_id', $value);}
    
    public function getPageName(){return $this->__get('page_name');}
    public function setPageName($value){$this->__set('page_name', $value);}
    
    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
}