<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nLanguage extends DbModel
{
    public function getModelId()
    {
        return 'i18n_language';
    }
}