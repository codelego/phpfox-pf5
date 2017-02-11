<?php

namespace Neutron\Notification\Model;


use Phpfox\Db\DbModel;

class NotificationType extends DbModel
{
    public function getModelId(){return 'notification_type';}

    public function getTypeId(){return $this->__get('type_id');}
    public function setTypeId($value){$this->__set('type_id', $value);}

    public function getPackageId(){return $this->__get('package_id');}
    public function setPackageId($value){$this->__set('package_id', $value);}

    public function getContent(){return $this->__get('content');}
    public function setContent($value){$this->__set('content', $value);}

    public function getHandlerId(){return $this->__get('handler_id');}
    public function setHandlerId($value){$this->__set('handler_id', $value);}

    public function isDefault(){return $this->__get('is_default') ?1:0;}
    public function setDefault($value){$this->__set('is_default',$value?1:0);}


}