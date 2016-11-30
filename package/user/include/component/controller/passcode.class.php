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
class User_Component_Controller_Passcode extends Phpfox_Component
{
    /**
     * Class process method which is used to execute this component.
     */
    public function process()
    {

        $this->template()
            ->setTitle(_p('how_to_get_passcode'))
            ->setBreadCrumb(_p('how_to_get_passcode'));

        $sQRCodeUrl = '';
        $oService = User_Service_Googleauth::instance();
        if (isset($_REQUEST['val'])){
            $aVals = $_REQUEST['val'];
        } else {
            $aVals = [];
        }
        $sEmail = '';

        if(Phpfox::isUser()){
            $aUser=  User_Service_User::instance()->get(Phpfox::getUserId(),true);
            $sEmail =  $aUser['email'];
        }

        if (!empty($aVals['email'])) {
            $sEmail = $aVals['email'];
        }

        if(!empty($sEmail)){
            $oService->setUser($sEmail);

            $sTargetUrl = $oService->createUrl($sEmail);

            $sQRCodeUrl = 'https://chart.googleapis.com/chart?' . http_build_query([
                    'cht' => 'qr',
                    'chl' => $sTargetUrl,
                    'chs' => '200x200',
                    'choe' => 'UTF-8',
                ]);
        }

        $this->template()
            ->assign([
                'sQRCodeUrl' => $sQRCodeUrl,
                'sEmail' => $sEmail,
            ]);

    }
}