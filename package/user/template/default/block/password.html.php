<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="main_break"></div>
<div id="js_progress_cache_loader"></div>
<form method="post" action="{url link='current'}" onsubmit="$(this).ajaxCall('user.updatePassword'); return false;">
	<div class="table form-group">
		<div class="table_left">
			{_p var='old_password'}:
		</div>
		<div class="table_right">
			<input type="password" name="val[old_password]" value="" size="30" class="form-control" autocomplete="off" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="separate"></div>
	
	<div class="table form-group">
		<div class="table_left">
			{_p var='new_password'}:
		</div>
		<div class="table_right">
			<input type="password" name="val[new_password]" value="" size="30" class="form-control" autocomplete="off" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table form-group">
		<div class="table_left">
			{_p var='confirm_password'}:
		</div>
		<div class="table_right">
			<input type="password" name="val[confirm_password]" value="" size="30" class="form-control" autocomplete="off" />
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table_clear form-group">
		<input type="submit" value="{_p var='update'}" class="button btn-primary" />
	</div>
</form>