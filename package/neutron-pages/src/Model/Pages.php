<?php

namespace Neutron\Pages\Model;

use Phpfox\Db\DbModel;

class Pages extends DbModel
{
    public function getModelId()
    {
        return 'pages';
    }

    public function getProfileName()
    {
        return $this->__get('profile_name');
    }
}