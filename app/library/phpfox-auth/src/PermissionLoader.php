<?php

namespace Phpfox\Auth;


use Neutron\User\Model\UserLevel;
use Phpfox\Routing\Parameters;
use Phpfox\Kernel\UserInterface;

class PermissionLoader
{
    public function getPermissionParameter($itemType, $levelId)
    {
        return _try('super.cache', ['permission.loader', $itemType, $levelId], 0,
            function () use ($itemType, $levelId) {


                /** @var UserInterface $itemModel */
                $itemModel = _model($itemType)->create();
                $levelType = $itemModel->getLevelType();

                $level = _find($levelType, $levelId);

                if(!$level){
                    throw new \InvalidArgumentException('Invalid parameters');
                }

                $testArray = [$levelId];
                $data =  $level->toArray();

                $data ['item_type'] = $itemType;
                $data ['level_type'] = $levelType;

                do {
                    /** @var UserLevel $level */
                    $level = _find($levelType, $levelId);

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