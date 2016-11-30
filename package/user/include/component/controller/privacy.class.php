<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: privacy.class.php 4514 2012-07-17 10:38:33Z Miguel_Espinoza $
 */
class User_Component_Controller_Privacy extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		Phpfox::isUser(true);
		
		if (!Phpfox::getUserParam('user.can_control_notification_privacy') && !Phpfox::getUserParam('user.can_control_profile_privacy'))
		{
			return Phpfox_Error::display(_p('privacy_settings_have_been_disabled_for_your_user_group'));
		}
		
		if (($aVals = $this->request()->getArray('val')))
		{
			if (User_Service_Privacy_Process::instance()->update($aVals))
			{
				$this->url()->send('user.privacy', null, _p('privacy_settings_successfully_updated'));
			}
		}

		list($aUserPrivacy, $aNotifications, $aProfiles, $aItems) = User_Service_Privacy_Privacy::instance()->get();
		
		$aUserInfo = User_Service_User::instance()->get(Phpfox::getUserId());
		
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_index_process')) ? eval($sPlugin) : false);

			$aMenus = array(
				'profile' => _p('profile'),
				'items' => _p('items'),
				'notifications' => _p('notifications'),
				'blocked' => _p('blocked_users')
			);
      if (Phpfox::getUserParam('user.hide_from_browse')){
        $aMenus['invisible'] = _p('invisible_mode');
      }
			if (!Phpfox::isModule('privacy'))
			{
				unset($aMenus['items']);
			}
			
			$this->template()->buildPageMenu('js_privacy_block',
				$aMenus,
				array(
					'no_header_border' => true,
					'link' => $this->url()->makeUrl(Phpfox::getUserBy('user_name')),
					'phrase' => _p('view_your_profile')
				)				
			);		
		

		if ($this->request()->get('view') == 'blocked')
		{
			$this->template()->assign(array('bGoToBlocked' => true));
		}
		$this->template()->setTitle(_p('privacy_settings'))
			->setBreadCrumb(_p('account'), $this->url()->makeUrl('profile'))
			->setBreadCrumb(_p('privacy_settings'), $this->url()->makeUrl('user.privacy'), true)
			->setFullSite()
			->setHeader(array(
					'privacy.css' => 'module_user'
				)
			)
			->assign(array(
                'aForms' => $aUserPrivacy['privacy'],
                'aPrivacyNotifications' => $aNotifications,
                'aProfiles' => $aProfiles,
                'aUserPrivacy' => $aUserPrivacy,
                'aBlockedUsers' => User_Service_Block_Block::instance()->get(),
                'aUserInfo' => $aUserInfo,
                'aItems' => $aItems
            ));
        return null;
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_index_clean')) ? eval($sPlugin) : false);
	}
}