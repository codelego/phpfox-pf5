<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\AclAction;
use Neutron\Core\Model\AclValue;
use Neutron\User\Model\UserLevel;
use Phpfox\Kernel\UserInterface;

class PermissionManager
{

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
        $itemModel = \Phpfox::model($itemType)->create();

        $levelModel = $itemModel->getLevelType();

        foreach ($domains as $domain => $names) {
            /** @var AclAction[] $entries */
            $entries = \Phpfox::model('acl_action')
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
            $level = \Phpfox::find($levelModel, $levelId);

            if (!$level) {
                break;
            }

            $testArray[] = $level->getLevelId();

            /** @var AclValue[] $entries */
            $entries = \Phpfox::model('acl_value')
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
        $itemModel = \Phpfox::model($itemType)->create();

        $levelModel = $itemModel->getLevelType();

        $level = \Phpfox::find($levelModel, $levelId);

        if (!$level) {
            throw new \InvalidArgumentException('Invalid parameters "levelType, levelId');
        }
        // build actionId and maps to value for each groups.

        foreach ($domains as $domain => $values) {
            $keys = array_keys($values);

            /** @var AclAction[] $aclActions */
            $aclActions = \Phpfox::model('acl_action')
                ->select()
                ->where('domain_id=?', (string)$domain)
                ->where('name in ?', $keys)
                ->all();


            // do not update if action does not exists

            foreach ($aclActions as $aclAction) {

                $valueActual = json_encode($values[$aclAction->getName()]);

                /** @var AclValue $aclValue */
                $aclValue = \Phpfox::model('acl_value')
                    ->select()
                    ->where('action_id=?', $aclAction->getActionId())
                    ->where('level_id=?', $levelId)
                    ->where('item_type=?', $itemType)
                    ->first();

                if (!$aclValue) {
                    $aclValue = \Phpfox::model('acl_value')->create([
                        'level_id'  => $levelId,
                        'item_type' => $itemType,
                        'action_id' => $aclAction->getActionId(),
                    ]);
                }

                $aclValue->setValueActual($valueActual);
                $aclValue->save();
            }
        }


        \Phpfox::trigger('onSettingsChanged');

        return true;
    }
}