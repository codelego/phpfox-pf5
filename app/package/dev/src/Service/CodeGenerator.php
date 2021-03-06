<?php

namespace Neutron\Dev\Service;

use Neutron\Core\Model\AclAction;
use Neutron\Core\Model\AclForm;
use Neutron\Core\Model\SettingForm;
use Neutron\Core\Model\SettingValue;
use Neutron\Dev\FormAdminAddGenerator;
use Neutron\Dev\FormAdminDeleteGenerator;
use Neutron\Dev\FormAdminEditGenerator;
use Neutron\Dev\FormAdminFilterGenerator;
use Neutron\Dev\FormPermissionGenerator;
use Neutron\Dev\FormSettingGenerator;
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
     * Database tables
     *
     * @var array
     */
    protected $dbTables = [];

    /**
     * CodeGenerator constructor.
     */
    public function __construct()
    {
        $this->dbTables = array_map(function ($tableName) {
            return substr($tableName, strlen(PHPFOX_TABLE_PREFIX));
        }, \Phpfox::get('db')->tables());
    }

    /**
     * @return AclForm[]
     */
    public function getAclForms()
    {
        return \Phpfox::model('acl_form')
            ->select('form_id')
            ->all();
    }

    /**
     * @return SettingForm[]
     */
    public function getSiteSettingForm()
    {
        return \Phpfox::model('setting_form')
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

        /** @var DevAction[] $devActions */
        $devActions = \Phpfox::model('dev_action')
            ->select()
            ->where('meta_id in ?', $selected)
            ->where('action_type <> ?', 'skip')
            ->all();

        foreach ($devActions as $devAction) {
            switch ($devAction->getActionType()) {
                case 'admin_add':
                    $this->updateElementsByTableInfo($devAction, null);
                    (new FormAdminAddGenerator($devAction))->process();
                    break;
                case 'admin_edit':
                    $this->updateElementsByTableInfo($devAction, null);
                    (new FormAdminEditGenerator($devAction))->process();
                    break;
                case 'admin_delete':
                    $this->updateElementsByTableInfo($devAction, null);
                    (new FormAdminDeleteGenerator($devAction))->process();
                    break;
                case 'admin_filter':
                    $this->updateElementsByTableInfo($devAction, null);
                    (new FormAdminFilterGenerator($devAction))->process();
                    break;
                case self::FORM_ACL_SETTINGS:
                    $this->updateElementsByAclSettingForm($devAction, null);
                    (new FormPermissionGenerator($devAction))->process();
                    break;
                case self::FORM_SITE_SETTINGS:
                    $this->updateElementsBySiteSettingsForm($devAction, null);
                    (new FormSettingGenerator($devAction))->process();
                    break;
                case 'model_class':
                    $this->updateElementsByTableInfo($devAction, null);
                    (new ModelGenerator($devAction))->process();
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
        $tables = $this->dbTables;

        $formTypes = [
            'admin_add',
            'admin_edit',
            'admin_delete',
            'admin_filter',
            'model_class',
        ];

        foreach ($formTypes as $actionType) {
            foreach ($tables as $tableName) {
                $entry = \Phpfox::model('dev_action')
                    ->select()
                    ->where('action_type=?', $actionType)
                    ->where('table_name=?', $tableName)
                    ->first();

                if ($entry) {
                    continue;
                }

                \Phpfox::model('dev_action')
                    ->create([
                        'action_type' => $actionType,
                        'table_name'  => $tableName,
                    ])->save();
            }
        }

        foreach ($tables as $tableName) {
            $entry = \Phpfox::model('dev_table')
                ->findById($tableName);

            if ($entry) {
                continue;
            }

            \Phpfox::model('dev_table')
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

        foreach ($this->getSiteSettingForm() as $settingForm) {
            $entry = \Phpfox::model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingForm->getId())
                ->first();

            if ($entry) {
                continue;
            }

            \Phpfox::model('dev_action')
                ->create([
                    'package_id'  => $settingForm->getPackageId(),
                    'text_domain' => 'admin.' . $settingForm->getFormId() . '_setting',
                    'action_type' => $actionType,
                    'table_name'  => $settingForm->getFormId(),
                ])->save();
        }
    }

    protected function updateSiteSettingElements()
    {
        $actionType = self::FORM_SITE_SETTINGS;
        foreach ($this->getSiteSettingForm() as $settingForm) {
            /** @var DevAction $devAction */
            $devAction = \Phpfox::model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingForm->getFormId())
                ->first();

            if (!$devAction) {
                continue;
            }
            $this->updateElementsBySiteSettingsForm($devAction, $settingForm);
        }
    }

    protected function updateUserGroupSettings()
    {
        $actionType = self::FORM_ACL_SETTINGS;

        foreach ($this->getAclForms() as $settingForm) {
            $entry = \Phpfox::model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $settingForm->getFormId())
                ->first();

            if ($entry) {
                continue;
            }

            \Phpfox::model('dev_action')
                ->create([
                    'package_id'  => $settingForm->getPackageId(),
                    'text_domain' => '_' . $settingForm->getPackageId() . '.' . $settingForm->getFormId() . '_acl',
                    'action_type' => $actionType,
                    'table_name'  => $settingForm->getFormId(),
                ])->save();
        }
    }

    protected function updateUserGroupElements()
    {
        $actionType = self::FORM_ACL_SETTINGS;
        foreach ($this->getAclForms() as $aclForm) {
            /** @var DevAction $devAction */
            $devAction = \Phpfox::model('dev_action')
                ->select()
                ->where('action_type=?', $actionType)
                ->where('table_name=?', $aclForm->getFormId())
                ->first();

            if (!$devAction) {
                continue;
            }
            $this->updateElementsByAclSettingForm($devAction, $aclForm);
        }
    }

    /**
     *
     */
    protected function upgradeElements()
    {
        /** @var DevTable[] $devTables */
        $devTables = \Phpfox::model('dev_table')
            ->select()
            ->where('package_id<>?', 'undefined')
            ->all();

        foreach ($devTables as $table) {

            if (!in_array($table, $this->dbTables)) {
                continue;
            }

            $tableName = $table->getId();
            $tableInfo = new TableInfo($tableName);

            $actions = $this->getActionByTableName($tableName);

            foreach ($actions as $action) {
                $this->updateElementsByTableInfo($action, $tableInfo);
            }
            // check column exists
        }
    }

    public function getActionByTableName($tableName)
    {
        return \Phpfox::model('dev_action')
            ->select()
            ->where('table_name=?', $tableName)
            ->all();
    }

    /**
     * @param TableInfo $tableInfo
     * @param DevAction $devAction
     */
    public function updateElementsByTableInfo($devAction, $tableInfo)
    {
        if (!$tableInfo) {
            $tableInfo = new TableInfo($devAction->getTableName());
        }


        /** @var DevElement[] $elements */
        $elements = \Phpfox::model('dev_element')
            ->select()
            ->where('meta_id=?', $devAction->getMetaId())
            ->all();

        $currents = [];
        foreach ($elements as $element) {
            $currents[] = $element->getElementName();
        }
        $insertColumnNames = array_diff(array_keys($tableInfo->getColumns()), $currents);

        $ordering = count($tableInfo->getColumns());
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
            if (in_array($column->getName(), $this->hideFields)) {
                $isActive = 0;
            }

            if ($column->isIdentity()) {
                $isActive = 0;
            }


            \Phpfox::model('dev_element')
                ->create([
                    'meta_id'        => $devAction->getMetaId(),
                    'package_id'     => $devAction->getPackageId(),
                    'is_identity'    => $column->isIdentity(),
                    'is_primary'     => $column->isPrimary(),
                    'primary_length' => count($tableInfo->getPrimary()),
                    'element_name'   => $column->getName(),
                    'label'          => $column->getLabel(),
                    'info'           => '' . $column->getLabel() . ' [Info]',
                    'note'           => '' . $column->getLabel() . ' [Note]',
                    'placeholder'    => $column->getLabel(),
                    'is_require'     => $column->isRequired(),
                    'maxlength'      => $maxLength,
                    'default_value'  => $column->getDefault(),
                    'factory_id'     => $factoryId,
                    'ordering'       => ++$ordering,
                    'is_active'      => $isActive,
                ])
                ->save();
        }

        if ($devAction->getActionType() == 'admin_filter') {
            // add query options
            /** @var DevElement[] $elements */
            $queryElement = \Phpfox::model('dev_element')
                ->select()
                ->where('meta_id=?', $devAction->getMetaId())
                ->where('element_name=?', 'q')
                ->first();

            if ($queryElement) {

            } else {
                \Phpfox::model('dev_element')
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
                        'ordering'       => 1,
                        'is_active'      => 1,
                    ])
                    ->save();
            }
        }
    }


    /**
     * @param DevAction   $devAction
     * @param SettingForm $settingForm
     */
    protected function updateElementsBySiteSettingsForm($devAction, $settingForm)
    {
        if (null == $settingForm) {
            $settingForm = \Phpfox::model('setting_form')
                ->findById($devAction->getTableName());
        }

        if (!$settingForm) {
            return;
        }

        /** @var SettingValue[] $settingValues */
        $settingValues = \Phpfox::model('setting_value')
            ->select()
            ->where('form_id=?', $settingForm->getFormId())
            ->order('ordering', 1)
            ->all();

        foreach ($settingValues as $settingValue) {
            $elementName = $settingValue->getDomainId() . '__' . $settingValue->getName();
            /** @var DevElement $devElement */
            $devElement = \Phpfox::model('dev_element')
                ->select()
                ->where('meta_id=?', $devAction->getMetaId())
                ->where('element_name=?', $elementName)
                ->first();

            if ($devElement) {
                $devElement->setOrdering($settingValue->getOrdering());
                $devElement->save();
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

            $devAction = \Phpfox::model('dev_element')
                ->create([
                    'meta_id'      => $devAction->getMetaId(),
                    'factory_id'   => $factoryId,
                    'element_name' => $elementName,
                    'ordering'     => $settingValue->getOrdering(),
                    'label'        => $label,
                    'note'         => '' . $label . ' [Note]',
                    'info'         => '' . $label . ' [Info]',
                    'is_require'   => $settingValue->getValueActual() != '""',
                    'is_active'    => 1,
                ]);

            $devAction->save();
        }
    }

    /**
     * @param DevAction $devAction
     * @param AclForm   $aclForm
     */
    protected function updateElementsByAclSettingForm($devAction, $aclForm)
    {
        if (!$aclForm) {
            $aclForm = \Phpfox::model('acl_form')
                ->select()
                ->where('form_id=?', $devAction->getTableName())
                ->first();
        }

        /** @var AclAction[] $settingActions */
        $settingActions = \Phpfox::model('acl_action')
            ->select()
            ->where('form_id=?', $aclForm->getId())
            ->all();

        foreach ($settingActions as $settingAction) {
            $elementName = $settingAction->getDomainId() . '__' . $settingAction->getName();

            /** @var DevElement $devElement */
            $devElement = \Phpfox::model('dev_element')
                ->select()
                ->where('meta_id=?', $devAction->getMetaId())
                ->where('element_name=?', $elementName)
                ->first();

            if ($devElement) {
                $devElement->setOrdering($settingAction->getOrdering());
                $devElement->save();
                continue;
            }
            $label = implode(' ', array_map(function ($v) {
                return ucfirst($v);
            }, explode('_', $settingAction->getName())));

            $devElement = \Phpfox::model('dev_element')
                ->create([
                    'meta_id'      => $devAction->getMetaId(),
                    'element_name' => $elementName,
                    'ordering'     => $settingAction->getOrdering(),
                    'label'        => $label,
                    'note'         => '' . $label . ' [Note]',
                    'info'         => '' . $label . ' [Info]',
                    'factory_id'   => 'yesno',
                    'is_require'   => 1,
                    'is_active'    => 1,
                ]);

            $devElement->save();
        }
    }

    protected function cleanDirtyData()
    {


        $sql
            = 'delete FROM pf5_dev_action WHERE
action_type IN (\'admin_add\',\'admin_edit\',\'admin_filter\',\'admin_delete\',\'model_class\')
AND TABLE_NAME NOT IN (SELECT TABLE_NAME FROM pf5_dev_table);';

        \Phpfox::get('db')->execute($sql);

        $sql
            = 'UPDATE `pf5_dev_action`, `pf5_dev_table` SET pf5_dev_action.package_id = pf5_dev_table.package_id WHERE
pf5_dev_action.`table_name` = pf5_dev_table.`table_name`';

        \Phpfox::get('db')->execute($sql);

        $sql = 'DELETE FROM pf5_dev_element WHERE meta_id NOT IN (SELECT meta_id FROM pf5_dev_action);';

        \Phpfox::get('db')->execute($sql);
    }
}