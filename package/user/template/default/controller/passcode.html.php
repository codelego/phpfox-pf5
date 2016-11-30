<?php
defined('PHPFOX') or exit('NO DICE!');
?>
<div class="table">
    <div class="table_right">
        <div class="extra_info">
            {_p var='google_2step_verify_description'}
        </div>
        {if $sQRCodeUrl}
        <div class="extra_info">
            {_p var='use_google_authencator_app_to_scan_this_qr_code'}
        </div>
        <div>
            <img src="{$sQRCodeUrl}" width="200" height="200" />
        </div>
        {/if}
    </div>
</div>
{if $sQRCodeUrl ==''}
<form method="post">
    <div class="table">
        <div class="table_left">
            {_p var='enter_your_email'}
        </div>
        <div class="table_right">
            <input class="form-control" type="email" required name="val[email]" value="{$sEmail}" placeholder="{_p var='enter_your_email'}"/>
        </div>
    </div>
    <div class="table_clear form-group">
        <button type="submit" class="button btn-danger">
            {_p var='submit'}
        </button>
    </div>
</form>
{/if}