<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\StorageAdapter;

class StorageManager
{
    /**
     * @return StorageAdapter []
     */
    public function getStorageAdapters()
    {
        return _model('storage_adapter')
            ->select()
            ->all();
    }
}