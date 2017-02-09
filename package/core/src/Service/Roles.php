<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreRole;

class Roles
{
    /**
     * @param int $id
     *
     * @return CoreRole
     */
    public function findById($id)
    {
        return \Phpfox::with('core_role')
            ->findById((int)$id);
    }
}