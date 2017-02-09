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
}