<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nPhrase extends DbModel
{
    public function getModelId()
    {
        return 'i18n_phrase';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function getLanguageId()
    {
        $lang = $this->__get('lang');
        return $lang ? $lang : 'n/a';
    }

    public function getDomain()
    {
        $domain = $this->__get('domain');
        return $domain ? $domain : 'n/a';
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