<?php

namespace Neutron\Dev\Service;

use Neutron\Core\Model\AclSettingAction;
use Neutron\Core\Model\AclSettingGroup;
use Neutron\Core\Model\SiteSettingGroup;
use Neutron\Core\Model\SiteSettingValue;
use Neutron\Dev\FormAdminAclSettingGenerator;
use Neutron\Dev\FormAdminAddGenerator;
use Neutron\Dev\FormAdminEditGenerator;
use Neutron\Dev\FormAdminFilterGenerator;
use Neutron\Dev\FormAdminSiteSettingGenerator;
use Neutron\Dev\Model\DevAction;
use Neutron\Dev\Model\DevElement;
use Neutron\Dev\Model\DevTable;
use Neutron\Dev\ModelGenerator;
use Neutron\Dev\TableInfo;

class CodeGenerator
{
    CONST FORM_ACL_SETTINGS = 'admin_acl_settings';

    CONST FORM_SITE_SETTINGS = 'admin_site_settings';

    protected $hideFields
        = [
            'created_at',
            'updated_at',
            'user_id',
            'parent_id',
            'parent_type',
            'poster_id',
            'poster_type',
            'view_count',
            'comment_count',
            'like_count',
            'share_count',
            'rating_avg',
            'is_default',
            'is_updated',
            'is_json',
            'item_count',
            'is_required',
        ];

    protected $formToScanFromTables
        = [
            'admin_add',
            'admin_edit',
            'admin_delete',
            'admin_filter',
        ];

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
     * @return SiteSettingGroup[]
     */
    public function getSiteSettingGroups()
    {
        return _model('site_setting_group')
            ->select()
            ->order('sort_order', 1)
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
                    (new FormAdminAddGenerator($actionMeta))->process();
                    break;
                case 'admin_edit':
                    (new FormAdminEditGenerator($actionMeta))->process();
                    break;
                case 'admin_delete':
                    break;
                case 'admin_filter':
                    (new FormAdminFilterGenerator($actionMeta))->process();
                    break;
                case self::FORM_ACL_SETTINGS:
                    (new FormAdminAclSettingGenerator($actionMeta))->process();
                    break;
                case self::FORM_SITE_SETTINGS:
                    (new FormAdminSiteSettingGenerator($actionMeta))->process();
                    break;
                case 'model_class':
                    (new ModelGenerator($actionMeta))->process();
                    break;
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
        /** update meta package id */
        $this->cleanDirtyData();


        /** update site settings */
        $this->updateSiteSettings();
        $this->updateSiteSettingElements();


        /** update user group settings */
        $this->updateUserGroupSettings();
        $this->updateUserGroupElements();

        /** upgrade admin model settings */
        $this->upgradeElements();

        /** update meta package id */
        $this->cleanDirtyData();
    }

    protected function updateSiteSettings()
    {
        $actionType = self::FORM_SITE_SETTINGS;

        foreach ($this->getSiteSettingGroups() as $settingGroup) {
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
                    'text_domain' => 'admin.' . $settingGroup->getGroupId() . '_setting',
                    'action_type' => $actionType,
                    'table_name'  => $settingGroup->getGroupId(),
                ])->save();
        }
    }

    protected function updateSiteSettingElements()
    {
        $actionType = self::FORM_SITE_SETTINGS;
        foreach ($this->getSiteSettingGroups() as $settingGroup) {
            /** @var DevAction $devAction */
            $devAction = _model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingGroup->getGroupId())
                ->first();

            if (!$devAction) {
                continue;
            }

            /** @var SiteSettingValue[] $settingValues */
            $settingValues = _model('site_setting_value')
                ->select()
                ->where('group_id=?', $settingGroup->getId())
                ->order('sort_order', 1)
                ->all();

            $sortOrder = 1;
            foreach ($settingValues as $settingValue) {
                $elementName = $settingValue->getGroupId() . '__' . $settingValue->getName();
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
                }, explode('_', $settingValue->getName())));

                $factoryId = 'text';


                if (substr($elementName, -3) == '_id') {
                    $factoryId = 'select';
                }

                if (preg_match('/(_enable|_disable|_active|_allow)/', $elementName)) {
                    $factoryId = 'yesno';
                }

                if (preg_match('/(_html_)/', $elementName)) {
                    $factoryId = 'textarea';
                }

                if (preg_match('/(_code|_path|_domain|_prefix)/', $elementName)) {
                    $factoryId = 'text';
                }

                if ($settingValue->getValueActual() == "1" or $settingValue->getValueActual() == "0") {
                    $factoryId = 'yesno';
                }

                $devAction = _model('dev_element')
                    ->create([
                        'meta_id'      => $devAction->getMetaId(),
                        'factory_id'   => $factoryId,
                        'element_name' => $elementName,
                        'sort_order'   => $sortOrder,
                        'label'        => $label,
                        'note'         => '[' . $label . ' Note]',
                        'info'         => '[' . $label . ' Info]',
                        'required'     => 1,
                        'is_active'    => 1,
                    ]);

                $devAction->save();
                ++$sortOrder;
            }
        }
    }

    protected function updateUserGroupSettings()
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

    protected function updateUserGroupElements()
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
                        'required'     => 1,
                        'is_active'    => 1,
                    ]);

                $devAction->save();
                ++$sortOrder;
            }
        }
    }

    /**
     *
     */
    protected function upgradeElements()
    {
        /** @var DevTable[] $tables */
        $tables = _model('dev_table')
            ->select()
            ->where('package_id<>?', 'undefined')
            ->all();

        foreach ($tables as $table) {
            $tableName = $table->getId();
            $tableInfo = new TableInfo($tableName);

            $actions = $this->getActionByTableName($tableName);

            foreach ($actions as $action) {
                $this->scanTableInfoToUpgradeElement($tableInfo, $action);
            }
            // check column exists
        }
    }

    public function getActionByTableName($tableName)
    {
        return _model('dev_action')
            ->select()
            ->where('table_name=?', $tableName)
            ->all();
    }

    /**
     * @param TableInfo $tableInfo
     * @param DevAction $devAction
     */
    public function scanTableInfoToUpgradeElement($tableInfo, $devAction)
    {
        /** @var DevElement[] $elements */
        $elements = _model('dev_element')
            ->select()
            ->where('meta_id=?', $devAction->getMetaId())
            ->all();

        $currents = [];
        foreach ($elements as $element) {
            $currents[] = $element->getElementName();
        }
        $insertColumnNames = array_diff(array_keys($tableInfo->getColumns()), $currents);

        $sort_order = count($tableInfo->getColumns());
        foreach ($insertColumnNames as $insertColumnName) {
            $column = $tableInfo->getColumn($insertColumnName);

            $factoryId = 'text';
            $maxLength = '';

            if ($column->isString()) {
                $factoryId = $column->isMultiLine() ? 'textarea' : 'text';
                $maxLength = $column->getLength();
            } elseif ($column->isBoolean()) {
                $factoryId = 'yesno';
            } elseif ($column->isNumber()) {
                $factoryId = 'text';
            }

            $isActive = 1;
            if (!in_array($column->getName(), $this->hideFields)) {
                $isActive = 0;
            }

            if ($column->isIdentity()) {
                $isActive = 0;
            }


            _model('dev_element')
                ->create([
                    'meta_id'        => $devAction->getMetaId(),
                    'package_id'     => $devAction->getPackageId(),
                    'is_identity'    => $column->isIdentity(),
                    'is_primary'     => $column->isPrimary(),
                    'primary_length' => count($tableInfo->getPrimary()),
                    'element_name'   => $column->getName(),
                    'label'          => $column->getLabel(),
                    'info'           => '[' . $column->getLabel() . ' Info]',
                    'note'           => '[' . $column->getLabel() . ' Note]',
                    'placeholder'    => $column->getLabel(),
                    'is_require'     => $column->isRequired(),
                    'maxlength'      => $maxLength,
                    'default_value'  => $column->getDefault(),
                    'factory_id'     => $factoryId,
                    'sort_order'     => ++$sort_order,
                    'is_active'      => $isActive,
                ])
                ->save();
        }

        if ($devAction->getActionType() == 'admin_filter') {
            // add query options
            /** @var DevElement[] $elements */
            $queryElement = _model('dev_element')
                ->select()
                ->where('meta_id=?', $devAction->getMetaId())
                ->where('element_name=?', 'q')
                ->first();

            if ($queryElement) {

            } else {
                _model('dev_element')
                    ->create([
                        'meta_id'        => $devAction->getMetaId(),
                        'package_id'     => $devAction->getPackageId(),
                        'is_identity'    => 0,
                        'is_primary'     => 0,
                        'primary_length' => 0,
                        'element_name'   => 'q',
                        'label'          => 'Keywords',
                        'info'           => '',
                        'note'           => '',
                        'placeholder'    => 'Keywords',
                        'is_require'     => 0,
                        'maxlength'      => 100,
                        'default_value'  => '',
                        'factory_id'     => 'text',
                        'sort_order'     => 1,
                        'is_active'      => 1,
                    ])
                    ->save();
            }
        }
    }


    protected function cleanDirtyData()
    {


        $sql
            = 'delete FROM pf5_dev_action WHERE
action_type IN (\'admin_add\',\'admin_edit\',\'admin_filter\',\'admin_delete\')
AND TABLE_NAME NOT IN (SELECT TABLE_NAME FROM pf5_dev_table);';

        _service('db')->execute($sql);

        $sql
            = 'UPDATE `pf5_dev_action`, `pf5_dev_table` SET pf5_dev_action.package_id = pf5_dev_table.package_id WHERE
pf5_dev_action.`table_name` = pf5_dev_table.`table_name`';

        _service('db')->execute($sql);

        $sql = 'DELETE FROM pf5_dev_element WHERE meta_id NOT IN (SELECT meta_id FROM pf5_dev_action);';

        _service('db')->execute($sql);
    }
}