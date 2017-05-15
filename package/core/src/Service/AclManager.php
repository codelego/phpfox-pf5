<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclRole;
use Neutron\Core\Model\AclSettingGroup;

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

    public function getSettingGroupIdOptions()
    {
        $select = _model('acl_setting_group')->select()->order('ordering', 1);
        return array_map(function (AclSettingGroup $settingGroup) {
            return ['value' => $settingGroup->getId(), 'label' => $settingGroup->getTitle()];
        }, $select->all());
    }

    public function findRoleIdOptions($typeId)
    {
        _get('core.roles')->getSettingGroupIdOptions();

    }
}