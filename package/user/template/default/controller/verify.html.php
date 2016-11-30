<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * Display the image details when viewing an image.
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_User
 * @version 		$Id: detail.class.php 254 2009-02-23 12:36:20Z Miguel_Espinoza $
 */

?>
{if isset($sTime)}
	<div>
	{_p var='the_link_that_brought_you_here_is_not_valid_it_may_already_have_expired' time=$sTime}
	</div>
{/if}

{if !isset($sTime)}
	<div>
		{_p var='this_site_is_very_concerned_about_security'}
	</div>
	<div>
		<input type="button" value="{_p var='resend_verification_email'}" class="button btn-primary" onclick="$.ajaxCall('user.verifySendEmail', 'iUser={$iVerifyUserId}'); return false;" />
	</div>
{/if}