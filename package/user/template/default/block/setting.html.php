<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: setting.html.php 1298 2009-12-05 16:19:23Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<form method="post" action="#" onsubmit="$('#js_updating_basic_info').hide(); $('#js_updating_basic_info_load').html($.ajaxProcess('{_p var='updating' phpfox_squote=true}')).show(); $(this).ajaxCall('user.updateAccountSettings'); return false;">
	{if Phpfox::getUserParam('user.can_edit_dob')}
	<div class="info">
		<div class="info_left">
			{required}{_p var='date_of_birth'}:
		</div>
		<div class="info_right">
			{select_date start_year='1900' end_year='2008' field_separator=' <div style="margin-top:5px;"></div> ' field_order='MDY'}
		</div>			
	</div>		
	<div class="separate" style="margin-top:5px;"></div>
	{/if}
	{if Phpfox::getUserParam('user.can_edit_gender_setting')}
	<div class="info">
		<div class="info_left">
			<label for="gender">{required}{_p var='gender'}:</label>
		</div>
		<div class="info_right">
			{select_gender}
		</div>			
	</div>
	{/if}
	<div class="info">
		<div class="info_left">
			<label for="country_iso">{required}{_p var='location'}:</label>
		</div>
		<div class="info_right form-inline">
			{select_location style='width:100px;'}
		</div>			
	</div>
		
	{foreach from=$aSettings item=aSetting}	
		<div class="info">
			<div class="info_left">
				{_p var=$aSetting.phrase_var_name}:
			</div>
			<div class="info_right">
				{template file='custom.block.form'}
			</div>			
		</div>	
	{/foreach}		
	
	{plugin call='user.template_block_setting_form'}
	
	<div id="js_updating_basic_info" style="margin-top:8px;">
		<input type="submit" value="{_p var='update'}" class="button btn-primary" />
			- <a href="#" onclick="$('#js_basic_info_data').show(); $('#js_basic_info_form').hide(); return false;">{_p var='cancel'}</a>
			- <a href="{url link='user.setting'}">{_p var='go_advanced'}</a>
	</div>
	<div id="js_updating_basic_info_load" style="margin-top:8px; display:none;">
	
	</div>
</form>