<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: browse.html.php 6960 2013-12-02 16:17:27Z Miguel_Espinoza $
 * {* *}
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{if defined('PHPFOX_IS_ADMIN_SEARCH')}

{if !PHPFOX_IS_AJAX}
<div class="block_search">
	<form method="get" action="{url link='admincp.user.browse'}">
		<div class="table form-group">
			<div class="table_left">
				{_p var='search'}:
			</div>
			<div class="table_right">
				{filter key='keyword'}
				<div class="extra_info">
					{_p var='within'}: {filter key='type'}
				</div>
			</div>
			<div class="clear"></div>
		</div>

		<div id="js_admincp_search_options" style="display:none;">

			<div class="table form-group">
				<div class="table_left">
					{_p var='user_group'}:
				</div>
				<div class="table_right">
					{filter key='group'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='gender'}:
				</div>
				<div class="table_right">
					{filter key='gender'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='location'}:
				</div>
				<div class="table_right">
					{filter key='country'}
					{module name='core.country-child' country_child_filter=true country_child_type='browse'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='city'}:
				</div>
				<div class="table_right">
					{filter key='city'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='zip_postal_code'}:
				</div>
				<div class="table_right">
					{filter key='zip'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='ip_address'}:
				</div>
				<div class="table_right">
					{filter key='ip'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='age_group'}:
				</div>
				<div class="table_right">
					{filter key='from'} {_p var="and"} {filter key='to'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='show_members'}:
				</div>
				<div class="table_right">
					{filter key='status'}
				</div>
				<div class="clear"></div>
			</div>
			<div class="table form-group">
				<div class="table_left">
					{_p var='sort_results_by'}:
				</div>
				<div class="table_right">
					{filter key='sort'}
				</div>
				<div class="clear"></div>
			</div>

			<div class="table_header">
				{_p var='custom_fields'}
			</div>
			{foreach from=$aCustomFields item=aCustomField}
				{template file='custom.block.foreachcustom'}
			{/foreach}
		</div>

		<div class="table_clear">
			<div class="table_clear_more_options">
				<a href="#" rel="{_p var='view_less_search_options'}" onclick="$('#js_admincp_search_options').toggle(); var text = $(this).text(); $(this).text($(this).attr('rel')); $(this).attr('rel', text); return false;">{_p var='view_more_search_options'}</a>
			</div>
			<input type="submit" value="{_p var='search'}" class="button btn-primary" name="search[submit]" />
		</div>
	</form>
</div>

<div class="block_content">
	{literal}
	<script>
		function process_admincp_browse() {
			$('input.button').hide();
			$('#table_hover_action_holder, .table_hover_action').prepend('<div class="t_center admincp-browse-fa"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		}

		function delete_users(response, form, data) {
			// p(form);
			$('.admincp-browse-fa').remove();
			$('input.button').show();
			for (var i in data) {
				var e = data[i];
					// p('is delete...');
					form.find('input[type="checkbox"]').each(function() {
						if ($(this).is(':checked')) {
							if (e.name == 'delete') {
								$('#js_user_' + $(this).val()).remove();
							}
							else {
								$(this).prop('checked', false);
								var thisClass = $('#js_user_' + $(this).val());
								thisClass.removeClass('is_checked').addClass('is_processed');
								setTimeout(function() {
									thisClass.removeClass('is_processed');
								}, 600);
							}
						}
					});
			}
		};
	</script>
	{/literal}
	<form method="post" action="{url link='admincp.user.browse'}" class="ajax_post" data-include-button="true" data-callback-start="process_admincp_browse" data-callback="delete_users">
{/if}
		{if $aUsers}
		<table cellpadding="0" cellspacing="0" {if isset($bShowFeatured) && $bShowFeatured == 1} id="js_drag_drop"{/if}>
		<tr>
			<th style="width:10px;">
				{if !PHPFOX_IS_AJAX}
					<input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" />
				{/if}
			</th>
			<th style="width:20px;"></th>
			<th>{_p var='user_id'}</th>
			<th>{_p var='photo'}</th>
			<th>{_p var='display_name'}</th>
			<th>{_p var='email_address'}</th>
			<th>{_p var='group'}</th>
			<th>{_p var='last_activity'}</th>
		</tr>
		{foreach from=$aUsers name=users key=iKey item=aUser}
		<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}" id="js_user_{$aUser.user_id}">
			<td>
				{if $aUser.user_group_id == ADMIN_USER_ID && Phpfox::getUserBy('user_group_id') != ADMIN_USER_ID}

				{else}
				<input type="checkbox" name="id[]" class="checkbox" value="{$aUser.user_id}" id="js_id_row{$aUser.user_id}" />

				{/if}
			</td>
		{if isset($bShowFeatured) && $bShowFeatured == 1}
			<td class="drag_handle"><input type="hidden" name="val[ordering][{$aUser.user_id}]" value="{$aUser.featured_order}" /></td>
		{/if}
			<td>
				<a href="#" class="js_drop_down_link" title="{_p var='manage'}">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
				<div class="link_menu">
					<ul>
						{if $aUser.user_group_id == ADMIN_USER_ID && Phpfox::getUserBy('user_group_id') != ADMIN_USER_ID}

						{else}
						<li><a href="{url link='admincp.user.add' id=$aUser.user_id}">{_p var='edit_user'}</a></li>
						{/if}
						{if $aUser.view_id == '1'}
						<li class="js_user_pending_{$aUser.user_id}">
							<a href="#" onclick="$.ajaxCall('user.userPending', 'type=1&amp;user_id={$aUser.user_id}'); return false;">
								{_p var='approve_user'}
							</a>
						</li>
						<li class="js_user_pending_{$aUser.user_id}">
							<a href="#" onclick="tb_show('{_p var='deny_user' phpfox_squote=true}', $.ajaxBox('user.showDenyUser', 'height=240&amp;width=400&amp;iUser={$aUser.user_id}'));return false;">
								{_p var='deny_user'}
							</a>
						</li>
						<!-- onclick="" -->
						{/if}
						<li><div  class="js_feature_{$aUser.user_id}">{if !isset($aUser.is_featured) || $aUser.is_featured < 0}<a href="#" onclick="$.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=1'); return false;">{_p var='feature_user'}{else}<a href="#" onclick="$.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=0'); return false;">{_p var='unfeature_user'}{/if}</a></div></li>
						{if (isset($aUser.pendingMail) && $aUser.pendingMail != '') || (isset($aUser.unverified) && $aUser.unverified > 0)}
							<li><div class="js_verify_email_{$aUser.user_id}"> <a href="#" onclick="$.ajaxCall('user.verifySendEmail', 'iUser={$aUser.user_id}'); return false;">{_p var='resend_verification_mail'}</a></div></li>
							<li><div class="js_verify_email_{$aUser.user_id}"> <a href="#" onclick="$.ajaxCall('user.verifyEmail', 'iUser={$aUser.user_id}'); return false;">{_p var='verify_this_user'}</a></div></li>
						{/if}
						{if $aUser.user_group_id == ADMIN_USER_ID && Phpfox::getUserBy('user_group_id') != ADMIN_USER_ID}

						{else}
						<li id="js_ban_{$aUser.user_id}">
							{if $aUser.is_banned}
								<a href="#" onclick="$.ajaxCall('user.ban', 'user_id={$aUser.user_id}&amp;type=0'); return false;">
									{_p var='un_ban_user'}
								</a>
							{else}
								<a href="{url link='admincp.user.ban' user=$aUser.user_id}">
									{_p var='ban_user'}
								</a>
							{/if}
						</li>
						{/if}
						{if Phpfox::getUserParam('user.can_delete_others_account')}
						    {if $aUser.user_group_id == ADMIN_USER_ID && Phpfox::getUserBy('user_group_id') != ADMIN_USER_ID}

						    {else}
						    <li>
							<div class="user_delete">
							    <a href="#" onclick="tb_show('{_p var='delete_user' phpfox_squote=true}', $.ajaxBox('user.deleteUser', 'height=240&amp;width=400&amp;iUser={$aUser.user_id}'));return false;" title="{_p var='delete_user_full_name' full_name=$aUser.full_name|clean}">{_p var='delete_user'}</a></div></li>
						    {/if}

						{/if}
						{if Phpfox::getUserParam('user.can_member_snoop')}
							<li><div class="user_delete"><a href="{url link='admincp.user.snoop' user=$aUser.user_id}" >{_p var='log_in_as_this_user'}</a></div></li>
						{/if}
					</ul>
				</div>
			</td>
			<td>#{$aUser.user_id}</td>
			<td>{img user=$aUser suffix='_50_square' max_width=50 max_height=50}</td>
			<td>{$aUser|user}</td>
			<td><a href="mailto:{$aUser.email}">{if (isset($aUser.pendingMail) && $aUser.pendingMail != '')} {$aUser.pendingMail} {else} {$aUser.email} {/if}</a>{if isset($aUser.unverified) && $aUser.unverified > 0} <span class="js_verify_email_{$aUser.user_id}" onclick="$.ajaxCall('user.verifyEmail', 'iUser={$aUser.user_id}');">{_p var='verify'}</span>{/if}</td>
			<td>
			{if ($aUser.status_id == 1)}
				<div class="js_verify_email_{$aUser.user_id}">{_p var='pending_email_verification'}</div>
			{/if}
			{if Phpfox::getParam('user.approve_users') && $aUser.view_id == '1'}
				<span id="js_user_pending_group_{$aUser.user_id}">{_p var='pending_approval'}</span>
			{elseif $aUser.view_id == '2'}
				{_p var='not_approved'}
			{else}
				{$aUser.user_group_title|convert}
			{/if}
			</td>
			<td>
			{if $aUser.last_activity > 0}
				{$aUser.last_activity|date:'core.profile_time_stamps'}
			{/if}
				{if !empty($aUser.last_ip_address)}
				<div class="p_4">
					(<a href="{url link='admincp.core.ip' search=$aUser.last_ip_address_search}" title="{_p var='view_all_the_activity_from_this_ip'}">{$aUser.last_ip_address}</a>)
				</div>
				{/if}
			</td>
		</tr>
		{/foreach}
		</table>

		{pager}

		{/if}

	{/if}
{if !PHPFOX_IS_AJAX && defined('PHPFOX_IS_ADMIN_SEARCH')}
		<div class="table_clear table_hover_action">
			<input type="submit" name="approve" value="{_p var='approve'}" class="button sJsCheckBoxButton disabled" disabled="disabled" />
			<input type="submit" name="ban" value="{_p var='ban'}" class="sJsConfirm button sJsCheckBoxButton disabled" disabled="disabled" />
			<input type="submit" name="unban" value="{_p var='un_ban'}" class="button sJsCheckBoxButton disabled" disabled="disabled" />
			<input type="submit" name="verify" value="{_p var='verify'}" class="button sJsCheckBoxButton disabled" disabled="disabled" />
			<input type="submit" name="resend-verify" value="{_p var='resend_verification_mail'}" class="button sJsCheckBoxButton disabled" disabled="disabled" />
			<input type="submit" name="delete" value="{_p var='delete'}" class="sJsConfirm button sJsCheckBoxButton disabled" disabled="disabled" />
		</div>
	</form>
</div>
{else}
	{if isset($highlightUsers) && !$bOldWay}
        {if !Phpfox::getParam('user.hide_recommended_user_block', false)}
        <div class="ajax" data-url="{url link='user.browse' recommend=1}"></div>
        {/if}
	<div class="ajax" data-url="{url link='user.browse' featured=1}"></div>
	{else}
		{if $aUsers}
		{if !PHPFOX_IS_AJAX}
		<div class="wrapper-items">
		{/if}
		{foreach from=$aUsers name=users item=aUser}
			{template file='user.block.rows_wide'}
		{/foreach}
		{pager}
		{if !PHPFOX_IS_AJAX}
		</div>
		{/if}
        {elseif !PHPFOX_IS_AJAX}
        {_p var="No members found."}
		{/if}
	{/if}
{/if}
