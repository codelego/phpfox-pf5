<?php
defined('PHPFOX') or exit('NO DICE!');

class  User_Component_Block_Friendship extends Phpfox_Component
{
    public function process()
    {
        $viewer_id = Phpfox::getUserId();
        $user_id = $this->getParam('friend_user_id');


        if (!$viewer_id)
            return false;

        if ($viewer_id == $user_id)
            return false;

        $is_friend = Friend_Service_Friend::instance()->isFriend($viewer_id, $user_id);
        if (!$is_friend) {
            $is_friend = (Friend_Service_Request_Request::instance()->isRequested($viewer_id, $user_id) ? 2 : false);
        }

        $iMutualCount = 0;
        if ($bShowExtra = $this->getParam('extra_info', false))
        {
            list($iMutualCount, ) = Friend_Service_Friend::instance()->getMutualFriends($user_id, 1);
        }

        $this->template()->assign([
            'user_id'   => $user_id,
            'is_friend' => $is_friend,
            'type' => $this->getParam('type', 'string'),
            'show_extra' => $bShowExtra,
            'mutual_count' => $iMutualCount
        ]);
    }
}