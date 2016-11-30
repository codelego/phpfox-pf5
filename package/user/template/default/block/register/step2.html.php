<?php
defined('PHPFOX') or exit('NO DICE!');
?>
	<div id="js_register_step2">
		{plugin call='user.template_default_block_register_step2_6'}
	{if !isset($bIsPosted) && Phpfox::getParam('user.multi_step_registration_form')}
		<div class="p_bottom_10">{_p var='complete_this_step_to_setup_your_personal_profile'}</div>
	{/if}
	{if Phpfox::getParam('core.registration_enable_dob')}
		<div class="table form-group">
			<div class="table_left">
				{required}{_p var='birthday'}:
			</div>
			<div class="table_right">						
				{select_date start_year=$sDobStart end_year=$sDobEnd field_separator=' / ' field_order='MDY' bUseDatepicker=false sort_years='DESC'}
			</div>			
		</div>
	{/if}
	{if Phpfox::getParam('core.registration_enable_gender')}
		<div class="table form-group">
			<div class="table_left">
				<label for="gender">{required}{_p var='i_am'}:</label>
			</div>
			<div class="table_right">
				{select_gender}
			</div>			
		</div>
	{/if}	
	{if Phpfox::getParam('core.registration_enable_location')}
		<div class="table form-group">
			<div class="table_left">
				<label for="country_iso">{required}{_p var='location'}:</label>
			</div>
			<div class="table_right">
				{select_location}
				{module name='core.country-child' country_force_div=true}
			</div>			
		</div>		
	{/if}
	{if Phpfox::getParam('core.city_in_registration')}
		<div class="table form-group">
			<div class="table_left">
				<label for="city_location">{_p var='city'}:</label>
			</div>
			<div class="table_right">
				<input class="form-control" type="text" name="val[city_location]" id="city_location" value="{value type='input' id='city_location'}" size="30" />
			</div>			
		</div>		
	{/if}
	
	{if Phpfox::getParam('core.registration_enable_timezone')}
		<div class="table form-group">
			<div class="table_left">
				{_p var='time_zone'}:
			</div>
			<div class="table_right">
				<select class="form-control" name="val[time_zone]">
				{foreach from=$aTimeZones key=sTimeZoneKey item=sTimeZone}
					<option value="{$sTimeZoneKey}"{if (Phpfox::getTimeZone() == $sTimeZoneKey && !isset($iTimeZonePosted)) || (isset($iTimeZonePosted) && $iTimeZonePosted == $sTimeZoneKey) || (Phpfox::getParam('core.default_time_zone_offset') == $sTimeZoneKey)} selected="selected"{/if}>{$sTimeZone}</option>
				{/foreach}
				</select>
			</div>
			<div class="clear"></div>
		</div>		
	{/if}
		{plugin call='user.template_default_block_register_step2_7'}
		{template file='user.block.custom'}
		{plugin call='user.template_default_block_register_step2_8'}
		{if Phpfox::isModule('subscribe') && Phpfox::getParam('subscribe.enable_subscription_packages') && count($aPackages)}
		<div class="separate"></div>
		<div class="table form-group">
			<div class="table_left">
				{if Phpfox::getParam('subscribe.subscribe_is_required_on_sign_up')}{required}{/if}{_p var='membership'}:
			</div>
			<div class="table_right">
				<select class="form-control" name="val[package_id]" id="js_subscribe_package_id">
				{if Phpfox::getParam('subscribe.subscribe_is_required_on_sign_up')}				
					<option value=""{value type='select' id='package_id' default='0'}>{_p var='select'}:</option>
				{else}
					<option value=""{value type='select' id='package_id' default='0'}>{_p var='free_normal'}</option>
				{/if}
				{foreach from=$aPackages item=aPackage}
					<option value="{$aPackage.package_id}"{value type='select' id='package_id' default=''$aPackage.package_id''}>{if $aPackage.show_price}({if $aPackage.default_cost == '0.00'}{_p var='free'}{else}{$aPackage.default_currency_id|currency_symbol}{$aPackage.default_cost}{/if}) {/if}{$aPackage.title|convert|clean}</option>
				{/foreach}
				</select>
				<div class="extra_info">
					<a href="#" onclick="tb_show('{_p var='membership_upgrades' phpfox_squote=true}', $.ajaxBox('subscribe.listUpgradesOnSignup', 'height=400&width=500')); return false;">{_p var='click_here_to_learn_more_about_our_membership_upgrades'}</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>				
		{/if}
	</div>
	
	{module name='user.showspamquestion'}
	
	{if Phpfox::getParam('user.force_user_to_upload_on_sign_up')}
		<div class="separate"></div>
		<div class="table form-group">
			<div class="table_left">
				{required}{_p var='profile_image'}:
			</div>
			<div class="table_right">
				<input type="file" name="image" accept="image/*"/>
				<div class="extra_info">
					{_p var='you_can_upload_a_jpg_gif_or_png_file'}
				</div>
			</div>			
		</div>
	{/if}
	
	