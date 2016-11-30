<?php 
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: manage.html.php 1821 2010-09-20 16:11:48Z Miguel_Espinoza $
 */

defined('PHPFOX') or exit('NO DICE!'); 

?>
<table id="js_drag_drop" cellpadding="0" cellspacing="0">
	<tr>
		<th></th> <!-- Change order -->
		<th style="width: 20px;"></th> <!-- Edit/Delete -->
		<th>{_p var='cancellation_reason'}</th>
		<th class="t_center" style="width:20px;">{_p var='active'}</th>
	</tr>

	{foreach from=$aReasons item=aReason key=iKey}
	<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td class="drag_handle"><input type="hidden" name="val[ordering][{$aReason.delete_id}]" value="{$aReason.ordering}" /></td>		
		<td class="t_center">
			<a href="#" class="js_drop_down_link" title="{_p var='manage'}">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
			<div class="link_menu">
				<ul>
					<li><a href="{url link='admincp.user.cancellations.add' id={$aReason.delete_id}">{_p var='edit_reason'}</a></li>
					<li><a href="{url link='admincp.user.cancellations.manage' delete={$aReason.delete_id}" class="sJsConfirm" data-message="{_p var='are_you_sure'}">{_p var='delete_reason'}</a></li>
				</ul>
			</div>
		</td>
		<td>{_p var=$aReason.phrase_var}</td>
		<td class="t_center">
			<div class="js_item_is_active"{if !$aReason.is_active} style="display:none;"{/if}>
				 <a href="#?call=core.updateCancellationsActivity&amp;id={$aReason.delete_id}&amp;active=0" class="js_item_active_link" title="{_p var='deactivate'}">{img theme='misc/bullet_green.png' alt=''}</a>
			</div>
			<div class="js_item_is_not_active"{if $aReason.is_active} style="display:none;"{/if}>
				 <a href="#?call=core.updateCancellationsActivity&amp;id={$aReason.delete_id}&amp;active=1" class="js_item_active_link" title="{_p var='activate'}">{img theme='misc/bullet_red.png' alt=''}</a>
			</div>
		</td>
	</tr>
	
{foreachelse}
<tr>
	<td colspan="4">
		<div class="extra_info">
			{_p var='there_are_no_options_available'}
			<ul>
				<li><a href="{url link='admincp.user.cancellations.add'}">{_p var='click_here_to_add'}</a></li>
			</ul>
		</div>
	</td>
</tr>
{/foreach}
</table>