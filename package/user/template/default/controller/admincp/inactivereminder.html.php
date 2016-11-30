<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: browse.html.php 2137 2010-11-15 13:37:06Z Raymond_Benc $
 * {* *}
 */
defined('PHPFOX') or exit('NO DICE!');
?>

<div class="block_search">
	<div class="table_header">
			{_p var='member_search'}
	</div>
	<div class="table form-group">
		<div class="table_left">
			{_p var='show_users_who_have_not_logged_in_for'}:
		</div>
		<div class="table_right">
			<input type="text" id="inactive_days" size="3" value="1"> {_p var='days'}
		</div>
		<div class="clear"></div>
	</div>

	<div class="table form-group">
		<div class="table_left">
			{_p var='send_mails_in_batches_of'}
		</div>
		<div class="table_right">
			<input type="text" id="mails_per_batch" size="3" value="0">
			<div class="extra_info">
				{_p var='enter_0_for_all_at_once'}
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="table form-group">
		<div class="table_left"></div>
		<div class="table_right">
			<div class="extra_info">{_p var='this_feature_uses_the_language'}</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="table_clear">
		<input type="submit" value="{_p var='get_members_count'}" class="button" id="btnSearch" />
		<input type="submit" value="{_p var='process_mailing_job'}" class="button btn-primary" id="btnProcess"/>
		<input type="submit" value="{_p var='stop_mailing_job'}" class="button" id="btnStop" />
	</div>
</div>
<div class="block_content">
	<div id="progress"></div>
</div>