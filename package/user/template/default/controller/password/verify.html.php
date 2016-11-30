<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: verify.html.php 4030 2012-03-20 12:28:59Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if Phpfox::getParam('user.shorter_password_reset_routine') && isset($sRequest)}
	
	<form action="{url link='user.password.verify' id=$sRequest}" method="post">
		<div>
			<input type="hidden" name="val[request]" class="js_attachment" value="{$sRequest}" />
		</div>
		<div class="table form-group">
			<div class="table_left">
				{_p var='new_password'}
			</div>
			<div class="table_right">
				<input class="form-control" type="password" name="val[newpassword]" autocomplete="off" />
			</div>		
		</div>
		<div class="table form-group">
			<div class="table_left">
				{_p var='confirm_password'}
			</div>
			<div class="table_right">
				<input class="form-control" type="password" name="val[newpassword2]" autocomplete="off" />
			</div>		
		</div>
		<div class="table form-group">
			<div class="table_left"> </div>
			<div class="table_right"> <input type="submit" class="button btn-danger" value="{_p var='update'}" /> </div>
	</form>

{/if}