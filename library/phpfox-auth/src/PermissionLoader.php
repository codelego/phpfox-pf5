<?php

namespace Phpfox\Auth;


use Neutron\User\Model\UserLevel;
use Phpfox\Routing\Parameters;
use Phpfox\Support\UserInterface;

class PermissionLoader
{
    public function getPermissionParameter($itemType, $levelId)
    {
        return _try('super.cache', ['permission.loader', $itemType, $levelId], 0,
            function () use ($itemType, $levelId) {
                $testArray = [$levelId];
                $data = [];

                /** @var UserInterface $itemModel */
                $itemModel = _model($itemType)->create();
                $levelModel = $itemModel->getLevelType();

                do {
                    /** @var UserLevel $level */
                    $level = _find($levelModel, $levelId);

                    if (!$level) {
                        break;
                    }

                    $items = _get('db')->select('av.*, ac.domain_id, ac.name')
                        ->from(':acl_value', 'av')
                        ->join(':acl_action', 'ac', 'ac.action_id=av.action_id')
                        ->where('av.level_id=?', $levelId)
                        ->where('av.item_type=?', $itemType)
                        ->all();

                    foreach ($items as $item) {
                        $key = sprintf('%s.%s', $item['domain_id'], $item['name']);
                        if (!array_key_exists($key, $data)) {
                            $data[$key] = json_decode($item['value_actual'], true);
                        }
                    }
                    $levelId = (int)$level->getLevelId();
                } while ($levelId and !in_array($levelId, $testArray));

                return new Parameters($data);
            });
    }
}