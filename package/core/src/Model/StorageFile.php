<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class StorageFile extends DbModel
{
    public function getModelId()
    {
        return 'storage_file';
    }

}