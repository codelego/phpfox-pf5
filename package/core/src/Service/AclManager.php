<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclRole;

class AclManager
{
    /**
     * @param int $id
     *
     * @return AclRole
     */
    public function findById($id)
    {
        return _model('acl_role')
            ->findById((int)$id);

    }

    public function findRoleIdOptions($typeId)
    {

    }
}