<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclAction;
use Neutron\Core\Model\AclForm;
use Neutron\Core\Model\AclValue;
use Neutron\User\Model\UserLevel;
use Phpfox\Support\UserInterface;

class PermissionManager
{
    public function getFormIdOptions()
    {
        $select = _model('acl_form')->select()->order('ordering', 1);
        return array_map(function (AclForm $aclForm) {
            return ['value' => $aclForm->getId(), 'label' => $aclForm->getTitle()];
        }, $select->all());
    }

    /**
     * @param string $itemType
     * @param int    $levelId
     * @param array  $domains
     *
     * @return array
     */
    public function getForEdit($itemType, $levelId, $domains)
    {

        // first load action id list.
        $actionMap = [];
        $actionIds = [];
        $result = [];
        $testArray = [$levelId];


        /** @var UserInterface $itemModel */
        $itemModel = _model($itemType)->create();

        $levelModel = $itemModel->getLevelType();

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

            /** @var UserLevel $level */
            $level = _find($levelModel, $levelId);

            if (!$level) {
                break;
            }

            $testArray[] = $level->getLevelId();

            /** @var AclValue[] $entries */
            $entries = _model('acl_value')
                ->select()
                ->where('action_id in ?', $actionIds)
                ->where('level_id=?', $levelId)
                ->where('item_type=?', $itemType)
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
     * @param string $itemType
     * @param string $levelId
     * @param array  $domains
     *
     * @return bool
     */
    public function updateValues($itemType, $levelId, $domains)
    {
        /** @var UserInterface $itemModel */
        $itemModel = _model($itemType)->create();

        $levelModel = $itemModel->getLevelType();

        $level = _find($levelModel, $levelId);

        if (!$level) {
            throw new \InvalidArgumentException('Invalid parameters "levelType, levelId');
        }
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
                    ->where('level_id=?', $levelId)
                    ->where('item_type=?', $itemType)
                    ->first();

                if (!$aclValue) {
                    $aclValue = _model('acl_value')->create([
                        'level_id'  => $levelId,
                        'item_type' => $itemType,
                        'action_id' => $aclAction->getActionId(),
                    ]);
                }

                $aclValue->setValueActual($valueActual);
                $aclValue->save();
            }
        }


        _trigger('onSettingsChanged');

        return true;
    }
}