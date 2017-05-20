<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclForm;
use Neutron\Core\Model\AclLevel;

class AclManager
{
    /**
     * @param int $id
     *
     * @return AclLevel
     */
    public function findById($id)
    {
        return _model('acl_level')
            ->findById((int)$id);

    }

    public function getFormIdOptions()
    {
        $select = _model('acl_form')->select()->order('ordering', 1);
        return array_map(function (AclForm $aclForm) {
            return ['value' => $aclForm->getId(), 'label' => $aclForm->getTitle()];
        }, $select->all());
    }

    public function findRoleIdOptions($typeId)
    {
        _get('core.roles')->getFormIdOptions();

    }
}