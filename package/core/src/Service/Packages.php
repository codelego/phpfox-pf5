<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CorePackage;

class Packages
{
    /**
     * Find a package entry by "id"
     *
     * @param mixed $id
     *
     * @return CorePackage|null
     */
    public function findById($id)
    {
        return \Phpfox::with('core_package')
            ->findById((int)$id);
    }

    public function getPackageIdOptions()
    {
        $select = \Phpfox::with('core_package')->select();

        return array_map(function (CorePackage $v) {
            return [
                'label' => $v->__get('name'),
                'value' => $v->__get('name'),
            ];
        }, $select->all());
    }
}