<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: filter.html.php 6860 2013-11-06 20:17:19Z Fern $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<form method="GET" action="{if isset($aCallback.url_home)}{url link=$aCallback.url_home view=$sView}{else}{url link='user.browse' view=$sView}{/if}">
{if isset($aCallback.url_home)}
	<div><input type="hidden" name="url_home" value="{$aCallback.url_home}" /></div>
{/if}
{if Phpfox::getUserParam('user.can_search_user_gender')}
	<div class="table form-group-follow">
		<div class="table_left">{_p var='browse_for'}</div>
		<div class="table_right">
			{filter key='gender'}
		</div>
	</div>
{/if}
{if Phpfox::getUserParam('user.can_search_user_age')}
	<div class="table form-group">
		<div class="table_left">{_p var='between_ages'}</div>
		<div class="table_right">
			{filter key='from'}&nbsp;{filter key='to'}
		</div>
	</div>
{/if}
	<div class="table form-group">
		<div class="table_left">{_p var='located_within'}</div>
		<div class="table_right">
			{filter key='country'}
			{module name='core.country-child' country_child_filter=true country_child_type='browse'}
		</div>
	</div>

	<div class="table form-group">
		<div class="table_left">{_p var='city'}</div>
		<div class="table_right">
			{filter key='city'}
		</div>
	</div>
	
	{if Phpfox::getUserParam('user.can_search_by_zip')}
		<div class="table form-group">
			<div class="table_left">{_p var='zip_postal_code'}</div>
			<div class="table_right">
				{filter key='zip'}
			</div>
		</div>
	{/if}
	
	<div class="table form-group">
		<div class="table_left">{_p var='keywords'}</div>
		<div class="table_right">
			{filter key='keyword'}
			<div class="extra_info" style="display:none;">
				{_p var='within'}: {filter key='type'}
			</div>
		</div>
	</div>

	<ul id="js_user_browse_advanced_link">
		<li><a href="#" onclick="$('.main_search_browse_button').toggle(); $('#js_user_browse_advanced').toggleClass('active'); return false;" id="user_browse_advanced_link">
                <span class="main_search_browse_button">{_p var='view_advanced_filters'}</span>
                <span class="main_search_browse_button" style="display: none">{_p var='close_advanced_filters'}</span>
            </a></li>
		{if isset($bIsInSearchMode) && $bIsInSearchMode}
		<li><a href="#"><a href="{url link='user.browse'}">{_p var='reset_browse_criteria'}</a></a></li>
		{/if}
	</ul>
		
	<div class="table_clear main_search_browse_button">
		<input type="submit" value="{_p var='search'}" class="button btn-primary" name="search[submit]" />
	</div>
	
	<div id="js_user_browse_advanced">
		<div class="user_browse_content">
			<div id="browse_custom_fields_popup_holder">
			    {foreach from=$aCustomFields name=customfield item=aCustomField}
				{if isset($aCustomField.fields)}
					{template file='custom.block.foreachcustom'}
				{/if}
			    {/foreach}
			</div>
			{if count($aForms)}
			{literal}
			<script type="text/javascript">
				$Behavior.user_filter_1 = function()
				{
					var iBrowseCnt = 0;
					$('#js_block_border_user_filter .menu li').each(function()
					{
						iBrowseCnt++;
						if (iBrowseCnt == 1)
						{
							$(this).removeClass('active');
						}
						else
						{
							$(this).addClass('active');
						}
					});
				};
			</script>
			{/literal}
			{/if}

			<div class="table form-group" style="display:none;">
			    <div class="table_left">{_p var='sort_results_by'}</div>
			    <div class="table form-group">
				{filter key='sort'} {filter key='sort_by'}
			    </div>
			</div>
			<div class="table_clear">
			    <input type="submit" value="{_p var='search'}" class="button btn-primary" name="search[submit]" />
			</div>
		</div>
	</div>
	
	{if isset($sCountryISO)}
		<script type="text/javascript">
			$Behavior.loadStatesAfterBrowse = function()
			{l}
				sCountryISO = "{$sCountryISO}";
				if(sCountryISO != "")
				{l}
					sCountryChildId = "{$sCountryChildId}";
					$.ajaxCall('core.getChildren', 'country_child_filter=true&country_child_type=browse&country_iso=' + sCountryISO + '&country_child_id=' + sCountryChildId);
				{r}
			{r}
		</script>
	{/if}
	
</form>
