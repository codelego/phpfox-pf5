<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<form method="post" action="{url link='user.photo'}" enctype="multipart/form-data" target="js_upload_photo_frame">
	<div><input type="hidden" name="val[is_iframe]" value="1" /></div>
	<div><input type="hidden" name="val[user_id]" value="{$iUserId}" /></div>
	<div class="table_header">
		{_p var='select_an_image'}
	</div>
	<div class="table form-group">
		<div class="table_left">
			{_p var='file'}:
		</div>
		<div class="table_right">
			<input type="file" name="image" accept="image/*" />
			<div class="extra_info">
				{_p var='you_can_upload_a_jpg_gif_or_png_file'}
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{_p var='upload_picture'}" class="button btn-primary" name="val[uploaded]" />
	</div>
</form>

<iframe frameborder="1" name="js_upload_photo_frame" id="js_upload_photo_frame" style="width:100%; height:200px; display:none;"></iframe>