<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: login-block.html.php 5318 2013-02-04 10:38:35Z Miguel_Espinoza $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{plugin call='user.template_controller_login_block__start'}
<form method="post" action="{url link="user.login"}">
	<div class="table form-group">
		<div class="table_right">
			<input placeholder="{if Phpfox::getParam('user.login_type') == 'user_name'}{_p var='user_name'}{elseif Phpfox::getParam('user.login_type') == 'email'}{_p var='email'}{else}{_p var='login'}{/if}" type="text" name="val[login]" id="js_email" value="" size="30" class="form-control" />
		</div>
	</div>

	<div class="table form-group">
		<div class="table_right">
			<div class="input-group">
				<input placeholder="{_p var='password'}" type="password" name="val[password]" id="js_password" value="" size="30" class="form-control" autocomplete="off" />
				<span class="input-group-btn">
				<button class="btn"><i class="fa fa-sign-in"></i></button>
			  </span>
			</div>
		</div>
	</div>

	<div class="table_clear form-group">
		<div class="user_rem_me checkbox">
			<label><input type="checkbox" name="val[remember_me]" value="" class="checkbox" /> {_p var='remember'}</label>
		</div>

    {plugin call='user.template.login_header_set_var'}
    {if isset($bCustomLogin)}
    <div class="p_top_8">
      {_p var='or_login_with'}:
      <div class="p_top_4">
        {plugin call='user.template_controller_login_block__end'}
      </div>
    </div>
    {/if}
	</div>
</form>
