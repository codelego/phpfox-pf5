<?php

namespace Neutron\Dev\Service;

use Neutron\Core\Model\AclSettingAction;
use Neutron\Core\Model\AclSettingGroup;
use Neutron\Dev\FormAdminAddGenerator;
use Neutron\Dev\FormAdminEditGenerator;
use Neutron\Dev\FormAdminFilterGenerator;
use Neutron\Dev\Model\DevAction;
use Neutron\Dev\ModelGenerator;

class CodeGenerator
{
    CONST FORM_ACL_SETTINGS = 'admin_acl_settings';

    /**
     * @return AclSettingGroup[]
     */
    public function getUserSettingGroups()
    {
        return _model('acl_setting_group')
            ->select()
            ->all();
    }

    /**
     * @param array $selected List of action meta id
     *
     * @return bool
     */
    public function generateFromActionMetaIds($selected)
    {
        if (empty($selected)) {
            return false;
        }

        /** @var DevAction[] $actionMetas */
        $actionMetas = _model('dev_action')
            ->select()
            ->where('meta_id in ?', $selected)
            ->where('action_type <> ?', 'skip')
            ->all();

        foreach ($actionMetas as $actionMeta) {
            switch ($actionMeta->getActionType()) {
                case 'admin_add':
                    return (new FormAdminAddGenerator($actionMeta))->process();
                case 'admin_edit':
                    return (new FormAdminEditGenerator($actionMeta))->process();
                case 'admin_delete':
                    break;
                case 'admin_filter':
                    return (new FormAdminFilterGenerator($actionMeta))->process();
                case 'model_class':
                    return (new ModelGenerator($actionMeta))->process();
            }
        }

        return true;
    }

    /**
     * Scan all tables to update model & action tables
     *
     * @return void
     */
    public function scans()
    {
        $tables = array_map(function ($tableName) {
            return substr($tableName, strlen(PHPFOX_TABLE_PREFIX));
        }, _service('db')->tables());

        $formTypes = [
            'admin_add',
            'admin_edit',
            'admin_delete',
            'admin_filter',
            'model_class',
        ];

        foreach ($formTypes as $actionType) {
            foreach ($tables as $tableName) {
                $entry = _model('dev_action')
                    ->select()
                    ->where('action_type=?', $actionType)
                    ->where('table_name=?', $tableName)
                    ->first();

                if ($entry) {
                    continue;
                }

                _model('dev_action')
                    ->create([
                        'action_type' => $actionType,
                        'table_name'  => $tableName,
                    ])->save();
            }
        }

        foreach ($tables as $tableName) {
            $entry = _model('dev_table')
                ->findById($tableName);

            if ($entry) {
                continue;
            }

            _model('dev_table')
                ->create([
                    'table_name' => $tableName,
                ])->save();
        }

        $this->updatePackageIdInfo();
        $this->scanUserGroupSettings();
        $this->scanUserGroupElements();

    }

    protected function scanUserGroupSettings()
    {
        $actionType = self::FORM_ACL_SETTINGS;

        foreach ($this->getUserSettingGroups() as $settingGroup) {
            $entry = _model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingGroup->getGroupId())
                ->first();

            if ($entry) {
                continue;
            }

            _model('dev_action')
                ->create([
                    'package_id'  => $settingGroup->getPackageId(),
                    'text_domain' => 'admin.' . $settingGroup->getGroupId() . '_acl',
                    'action_type' => $actionType,
                    'table_name'  => $settingGroup->getGroupId(),
                ])->save();
        }
    }

    protected function scanUserGroupElements()
    {
        $actionType = self::FORM_ACL_SETTINGS;
        foreach ($this->getUserSettingGroups() as $settingGroup) {
            /** @var DevAction $devAction */
            $devAction = _model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingGroup->getGroupId())
                ->first();

            if (!$devAction) {
                continue;
            }

            /** @var AclSettingAction[] $settingActions */
            $settingActions = _model('acl_setting_action')
                ->select()
                ->where('group_id=?', $settingGroup->getId())
                ->all();

            $sortOrder = 1;
            foreach ($settingActions as $settingAction) {
                $elementName = $settingAction->getGroupId() . '__' . $settingAction->getName();
                $devElement = _model('dev_element')
                    ->select()
                    ->where('meta_id=?', $devAction->getMetaId())
                    ->where('element_name=?', $elementName)
                    ->first();

                if ($devElement) {
                    continue;
                }
                $label = implode(' ', array_map(function ($v) {
                    return ucfirst($v);
                }, explode('_', $settingAction->getName())));

                $devAction = _model('dev_element')
                    ->create([
                        'meta_id'      => $devAction->getMetaId(),
                        'element_name' => $elementName,
                        'sort_order'   => $sortOrder,
                        'label'        => $label,
                        'note'         => '[' . $label . ' Note]',
                        'info'         => '[' . $label . ' Info]',
                        'factory_id'   => 'yesno',
                        'is_active'    => 1,
                    ]);

                $devAction->save();
                ++$sortOrder;
            }
        }
    }


    protected function updatePackageIdInfo()
    {
        $sql
            = 'UPDATE `pf5_dev_action`, `pf5_dev_table` SET pf5_dev_action.package_id = pf5_dev_table.package_id WHERE
pf5_dev_action.`table_name` = pf5_dev_table.`table_name`';

        _service('db')->execute($sql);
    }
}