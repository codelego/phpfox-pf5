<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nPhrase extends DbModel
{
    public function getModelId()
    {
        return 'i18n_phrase';
    }

    public function getLanguageId()
    {
        return $this->__get('lang');
    }

    public function getDomain()
    {
        return $this->__get('domain');
    }

    public function getName()
    {
        return $this->__get('var_name');
    }

    public function getTextValue()
    {
        return $this->__get('text_value');
    }
}