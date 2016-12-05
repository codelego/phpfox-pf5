<?php

namespace Neutron\Core\Service;


use Phpfox\Package\PackageLoaderInterface;

class PackageLoader implements PackageLoaderInterface
{
    public function loadEnabledPackages()
    {
        $all = \Phpfox::getDb()
            ->select('*')
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->execute()
            ->all();

        $result = [];
        foreach ($all as $item) {
            $result[$item['feature']] = $item;
        }

        return $result;
    }

    public function loadPackageInfo($id)
    {
        return \Phpfox::getDb()
            ->select('*')
            ->from(':core_package')
            ->where('id=?', $id)
            ->execute()
            ->first();
    }


}