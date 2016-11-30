<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

define('PHPFOX_DONT_SAVE_PAGE', true);

/**
 * This controller receives the link for verifying a member's email address
 *
 * @copyright        [PHPFOX_COPYRIGHT]
 * @author        Miguel Espinoza
 * @package        Module_User
 * @version        $Id: browse.class.php 719 2009-06-29 12:23:19Z Miguel_Espinoza $
 */
class User_Component_Controller_Sms_Send extends Phpfox_Component
{
    /**
     * Class process method which is used to execute this component.
     */
    public function process()
    {
        $iStep = 1;
        $aVals = $_REQUEST['val'];
        $sPhone = !empty($aVals['phone']) ? $aVals['phone'] : '';
        $sEmail = Phpfox::getLib('session')->get('sms_verify_email');


        if (!empty($aVals['phone'])) {
            $iStep = 2;
        }

        if (!empty($aVals['verify_sms_token'])) {
            $iStep = 3;
        }

        if (!empty($aVals['resend_passcode'])) {
            $iStep = 1;
        }

        $oService = Phpfox::getLib('phpfox.verify');

        if ($iStep == 2) {
            if (!empty($aVals['email'])) {
                $sEmail = $aVals['email'];
                Phpfox::getLib('session')->set('sms_verify_email', $sEmail);
            }

            $sPhone = $aVals['phone'];

            $sSendToken = User_Service_Verify_Verify::instance()->getVerifyHashByEmail($sEmail);

            $sSendToken = substr($sSendToken, 0, 3) . ' ' . substr($sSendToken, 3);

            $sMsg = _p('sms_registration_verification_message', ['token' => $sSendToken]);

            $bResult = $oService
                ->sendSMS($sPhone, $sMsg);

            if (!$bResult) {
                Phpfox_Error::set(_p('invalid_phone_number_or_contact_admin', ['phone' => $sPhone]));
                $iStep = 1;
            }
        }

        $sToken = $aVals['verify_sms_token'];

        if ($iStep == 3) {
            if (User_Service_Verify_Process::instance()->verify($sToken)) {
                if ($sPlugin = Phpfox_Plugin::get('user.component_verify_process_redirection')) {
                    eval($sPlugin);
                }

                $sRedirect = Phpfox::getParam('user.redirect_after_signup');

                if (!empty($sRedirect)) {
                    Phpfox::getLib('session')->set('redirect', str_replace('.', '/', $sRedirect));
                }

                // send to the log in and say everything is ok
                Phpfox::getLib('session')->set('verified_do_redirect', '1');
                if (Phpfox::getParam('user.approve_users')) {
                    $this->url()->send('', null, _p('your_account_is_pending_approval'));
                }
                $this->url()->send('user.login', null, _p('your_account_has_been_verified_please_log_in_with_the_information_you_provided_during_sign_up'));
            } else {
                Phpfox_Error::set(_p('invalid_verification_token'));
            }
        }

        $this->template()
            ->assign([
                'iStep' => $iStep,
                'sPhone' => $sPhone,
                'sEmail' => $sEmail,
            ])
            ->setTitle(_p('account_verification'))
            ->setBreadCrumb(_p('account_verification'))
            ->setHeader('cache', array(
                    'jquery/plugin/intlTelInput.js' => 'static_script',
                )
            );
    }
}