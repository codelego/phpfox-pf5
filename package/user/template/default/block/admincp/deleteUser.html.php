<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: deleteUser.html.php 2935 2011-08-31 07:05:39Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if User_Service_User::instance()->isAdminUser('' . $iUserIdDelete . '')}
<div class="error_message">
	{_p var='you_are_unable_to_delete_a_site_administrator'}
</div>
{else}
<div>
	<div class="error_message">{_p var='are_you_completely_sure_you_want_to_delete_this_user'}</div>
	<div class="table_clear">
		<input type="button" class="button button_off" value="{_p var='no_cancel'}" onclick="tb_remove();">
		<input type="button" class="button" value="{_p var='yes_delete'}" onclick="$.ajaxCall('user.confirmedDelete', 'iUser={$aUser.user_id}');">
	</div>
</div>
{/if}