<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclAction;
use Neutron\Core\Model\AclForm;
use Neutron\Core\Model\AclLevel;
use Neutron\Core\Model\AclValue;

class PermissionManager
{
    /**
     * @param int $id
     *
     * @return AclLevel
     */
    public function findById($id)
    {
        return _model('acl_level')->findById((int)$id);
    }

    public function getFormIdOptions()
    {
        $select = _model('acl_form')->select()->order('ordering', 1);
        return array_map(function (AclForm $aclForm) {
            return ['value' => $aclForm->getId(), 'label' => $aclForm->getTitle()];
        }, $select->all());
    }

    /**
     * @param mixed $levelType
     * @param mixed $levelId
     *
     * @return AclLevel
     */
    public function getAclLevel($levelType, $levelId)
    {
        return _model('acl_level')
            ->select()
            ->where('level_type=?', (string)$levelType)
            ->where('level_id=?', (int)$levelId)
            ->first();
    }

    /**
     * @param string $levelType
     * @param int    $levelId
     * @param array  $domains
     *
     * @return array
     */
    public function getForEdit($levelType, $levelId, $domains)
    {

        // first load action id list.
        $actionMap = [];
        $actionIds = [];
        $result = [];
        $testArray = [$levelId];

        foreach ($domains as $domain => $names) {
            /** @var AclAction[] $entries */
            $entries = _model('acl_action')
                ->select()
                ->where('domain_id=?', (string)$domain)
                ->where('name in ?', $names)
                ->all();
            foreach ($entries as $entry) {
                $actionMap['_' . $entry->getId()] = $domain . '__' . $entry->getName();
                $actionIds[] = $entry->getId();
            }
        }

        if (empty($actionIds)) {
            return [];
        }

        do {
            $level = $this->getAclLevel($levelType, $levelId);

            if (!$level) {
                break;
            }

            $testArray[] = $level->getLevelId();

            /** @var AclValue[] $entries */
            $entries = _model('acl_value')
                ->select()
                ->where('action_id in ?', $actionIds)
                ->where('internal_id=?', (int)$level->getInternalId())
                ->all();

            foreach ($entries as $entry) {

                $key = $actionMap['_' . $entry->getActionId()];

                if (!array_key_exists($key, $result)) {
                    $result[$key] = json_decode($entry->getValueActual(), true);
                }
            }
            $levelId = (int)$level->getInheritId();

        } while ($levelId and !in_array($levelId, $testArray));

        return $result;
    }

    /**
     * @param string $levelType
     * @param string $levelId
     * @param array  $domains
     *
     * @return bool
     */
    public function updateValues($levelType, $levelId, $domains)
    {
        $level = $this->getAclLevel($levelType, $levelId);

        if (!$level) {
            throw new \InvalidArgumentException('Invalid parameters "levelType, levelId');
        }

        $internalId = $level->getInternalId();


        // build actionId and maps to value for each groups.

        foreach ($domains as $domain => $values) {
            $keys = array_keys($values);

            /** @var AclAction[] $aclActions */
            $aclActions = _model('acl_action')
                ->select()
                ->where('domain_id=?', (string)$domain)
                ->where('name in ?', $keys)
                ->all();


            // do not update if action does not exists

            foreach ($aclActions as $aclAction) {

                $valueActual = json_encode($values[$aclAction->getName()]);

                /** @var AclValue $aclValue */
                $aclValue = _model('acl_value')
                    ->select()
                    ->where('action_id=?', $aclAction->getActionId())
                    ->where('internal_id=?', $internalId)
                    ->first();

                if (!$aclValue) {
                    $aclValue = _model('acl_value')->create([
                        'internal_id' => $internalId,
                        'action_id'   => $aclAction->getActionId(),
                    ]);
                }

                $aclValue->setValueActual($valueActual);
                $aclValue->save();
            }
        }


        _trigger('onSettingsChanged');

        return true;
    }


    public function findRoleIdOptions($typeId)
    {
        _get('core.permission')->getFormIdOptions();
    }
}