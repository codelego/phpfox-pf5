<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: register.html.php 5143 2013-01-15 14:16:21Z Miguel_Espinoza $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<script type="text/javascript">
    $Behavior.termsAndPrivacy = function()
    {
        $('#js_terms_of_use').click(function()
        {
            {/literal}
            tb_show('{_p var='terms_of_use' phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true}', $.ajaxBox('page.view', 'height=410&width=600&title=terms'));
            {literal}
            return false;
        });

        $('#js_privacy_policy').click(function()
        {
            {/literal}
            tb_show('{_p var='privacy_policy' phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true phpfox_squote=true}', $.ajaxBox('page.view', 'height=410&width=600&title=policy'));
            {literal}
            return false;
        });
    }
</script>
{/literal}

{if Phpfox_Module::instance()->getFullControllerName() == 'user.register' && Phpfox::isModule('invite')}
<div class="block">
    <div class="content">
        {/if}
        {if Phpfox::isModule('invite') && Invite_Service_Invite::instance()->isInviteOnly()}
        <div class="main_break">
            <div class="extra_info">
                {_p var='ssitetitle_is_an_invite_only_community_enter_your_email_below_if_you_have_received_an_invitation' sSiteTitle=$sSiteTitle}
            </div>
            <div class="main_break">
                <form method="post" action="{url link='user.register'}">
                    <div class="table form-group">
                        <div class="table_left">
                            {_p var='email'}:
                        </div>
                        <div class="table_right">
                            <input type="text" name="val[invite_email]" value="" />
                        </div>
                    </div>
                    <div class="table_clear">
                        <input type="submit" value="{_p var='submit'}" class="button_register" />
                    </div>
                </form>
            </div>
        </div>
        {else}
        {if isset($sCreateJs)}
        {$sCreateJs}
        {/if}
        <div id="js_registration_process" class="t_center" style="display:none;">
            <div class="p_top_8">
                {img theme='ajax/add.gif' alt=''}
            </div>
        </div>
        <div id="js_signup_error_message" style="width:350px;"></div>
        {if Phpfox::getParam('user.allow_user_registration')}
        <ul class="signin_signup_tab clearfix">
            <li><a class="keepPopup" rel="hide_box_title" href="{url link='login'}">{_p var='sign_in'}</a></li>
            <li class="active"><a rel="hide_box_title" href="javascript:void(0)">{_p var='sign_up'}</a></li>
        </ul>
        <div class="main_break" id="js_registration_holder">
            <form method="post" action="{url link='user.register'}" id="js_form" enctype="multipart/form-data">
                {token}

                <div id="js_signup_block">
                    {if isset($bIsPosted) || !Phpfox::getParam('user.multi_step_registration_form')}
                    <div>
                        {template file='user.block.register.step1'}
                        {template file='user.block.register.step2'}
                    </div>
                    {else}
                    {template file='user.block.register.step1'}
                    {/if}
                </div>
                {plugin call='user.template_controller_register_pre_captcha'}
                {if Phpfox::isModule('captcha') && Phpfox::getParam('user.captcha_on_signup')}
                <div id="js_register_capthca_image"{if Phpfox::getParam('user.multi_step_registration_form') && !isset($bIsPosted)} style="display:none;"{/if}>
                {module name='captcha.form'}
        </div>
        {/if}

        {if Phpfox::getParam('user.new_user_terms_confirmation')}
        <div id="js_register_accept">
            <div class="table form-group">
                <div class="table_clear">
                    <input type="checkbox" name="val[agree]" id="agree" value="1" class="checkbox v_middle" {value type='checkbox' id='agree' default='1'}/> {required}{_p var='i_have_read_and_agree_to_the_a_href_id_js_terms_of_use_terms_of_use_a_and_a_href_id_js_privacy_policy_privacy_policy_a'}
                </div>
            </div>
        </div>
        {/if}

        <div class="table_clear">
            {if isset($bIsPosted) || !Phpfox::getParam('user.multi_step_registration_form')}
            <input type="submit" value="{_p var='sign_up_button'}" class="button btn-success text-uppercase" id="js_registration_submit" />
            {else}
            <input type="button" value="{_p var='sign_up_button'}" class="button btn-success text-uppercase" id="js_registration_submit" onclick="$Core.registration.submitForm();" />
            {/if}
        </div>
        </form>
    </div>
    {/if}
    {/if}
    {if Phpfox_Module::instance()->getFullControllerName() == 'user.register'}
</div>
</div>
{/if}
