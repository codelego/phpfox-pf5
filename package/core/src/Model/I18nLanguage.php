<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nLanguage extends DbModel
{
    public function getModelId()
    {
        return 'i18n_language';
    }

    public function getTitle()
    {
        if (!empty($this->_data['native_name'])) {
            return $this->_data['native_name'];
        }

        if (!empty($this->_data['name'])) {
            return $this->_data['name'];
        }

        return $this->_data['id'];
    }
}