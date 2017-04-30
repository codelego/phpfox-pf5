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
        return \Phpfox::with('storage_adapter')
            ->select()
            ->all();
    }
}