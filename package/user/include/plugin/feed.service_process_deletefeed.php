<?php
defined('PHPFOX') or exit('NO DICE!');

if (Phpfox::isUser() && Phpfox_Request::instance()->get('module') == '' && $aFeed['parent_user_id'] == Phpfox::getUserId() && Phpfox::getUserParam('feed.can_remove_feeds_from_profile'))
{
	define('PHPFOX_FEED_CAN_DELETE', true);
}
?>