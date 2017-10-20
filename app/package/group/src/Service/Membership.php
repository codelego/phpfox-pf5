<?php

namespace Neutron\Group\Service;

use Phpfox\Kernel\UserInterface;

class Membership
{
    /**
     * @param UserInterface $parent
     * @param UserInterface $user
     * @param string        $relationType
     *
     * @return array
     */
    public function getRelationship($parent, $user, $relationType)
    {
        if ($relationType == 'member') {
            return array_map(function ($v) {
                return $v['user_id'];
            }, _model('friend')
                ->select('user_id')
                ->where('parent_id=?', $parent->getId())
                ->where('user_id=?', $user->getId())
                ->setPrototype(null)
                ->all());
        }

        if ($relationType == 'member_list') {
            return array_map(function ($v) {
                return $v['user_id'];
            }, _model('friend_list')
                ->select('user_id')
                ->where('parent_id=?', $parent->getId())
                ->where('user_id=?', $user->getId())
                ->setPrototype(null)
                ->all());
        }
        return [];
    }
}