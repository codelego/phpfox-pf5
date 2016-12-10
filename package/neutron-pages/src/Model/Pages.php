<?php

namespace Neutron\Pages\Model;

use Phpfox\Db\DbModel;

class Pages extends DbModel
{
    public function getModelId()
    {
        return 'pages';
    }
}