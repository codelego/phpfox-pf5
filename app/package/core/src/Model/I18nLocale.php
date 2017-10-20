<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class I18nLocale extends DbModel
{
    public function getModelId(){return 'i18n_locale';}

    public function getLocaleId(){return $this->__get('locale_id');}
    public function getId(){return $this->__get('locale_id');}
    public function setLocaleId($value){$this->__set('locale_id', $value);}
    public function setId($value){$this->__set('locale_id', $value);}
    
    public function getName(){return $this->__get('name');}
    public function setName($value){$this->__set('name', $value);}
    
    public function getNativeName(){return $this->__get('native_name');}
    public function setNativeName($value){$this->__set('native_name', $value);}
    
    public function getCode6391(){return $this->__get('code_6391');}
    public function setCode6391($value){$this->__set('code_6391', $value);}
    
    public function getDirectionId(){return $this->__get('direction_id');}
    public function setDirectionId($value){$this->__set('direction_id', $value);}
    
    public function isActive(){return $this->__get('is_active') ?1:0;}
    public function setActive($value){$this->__set('is_active',$value?1:0);}
    
    public function isDefault(){return $this->__get('is_default') ?1:0;}
    public function setDefault($value){$this->__set('is_default',$value?1:0);}
    }