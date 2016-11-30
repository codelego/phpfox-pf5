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
 * @package 		Phpfox_Component
 * @version 		$Id: controller.class.php 103 2009-01-27 11:32:36Z Raymond_Benc $
 */
class User_Component_Controller_Admincp_Add extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$this->_setMenuName('admincp.user.browse');
		
		$bIsEdit = false;		
		if (($iId = $this->request()->getInt('id')))
		{
			if (($aUser = User_Service_User::instance()->getForEdit($iId)))
			{
				$bIsEdit = true;
				
				if (!empty($aUser['birthday']))
				{
					$aUser = array_merge($aUser, User_Service_User::instance()->getAgeArray($aUser['birthday']));
				}				
				$this->template()->assign('aForms', $aUser);	
				
				if (User_Service_User::instance()->isAdminUser($aUser['user_id']))
				{
					return Phpfox_Error::display(_p('you_are_unable_to_edit_a_site_administrators_account'));
				}
			}
		}
		if (!isset($aUser))
		{
			$this->url()->send('admincp', null, 'This section requires that you select.');
		}
		if (($aVals = $this->request()->getArray('val')))
		{			
			if ($bIsEdit)
			{
				if (User_Service_Process::instance()->updateAdvanced($aUser['user_id'], $aVals))
				{
                    Custom_Service_Process::instance()->updateFields($aUser['user_id'], Phpfox::getUserId(), $this->request()->getArray('custom'));
					
					if (Phpfox::getUserParam('user.can_edit_other_user_privacy'))
					{
                        User_Service_Privacy_Process::instance()->update($aVals, $aUser['user_id']);
					}
					
					$this->url()->send('admincp.user.add', array('id' => $aUser['user_id']), _p('user_successfully_updated'));
				}
			}
			else 
			{
				
			}		
		}
		
		$aUserGroups = array();
		foreach (User_Service_Group_Group::instance()->get() as $aUserGroup)
		{
			$aUserGroups[$aUserGroup['user_group_id']] = Phpfox_Locale::instance()->convert($aUserGroup['title']);
		}		
		
		$aLanguages = array();
		foreach (Language_Service_Language::instance()->get(array('l.user_select = 1')) as $aLanguage)
		{
			$aLanguages[$aLanguage['language_id']] = Phpfox::getLib('parse.output')->clean($aLanguage['title']);
		}
		
		$aEditForm = array(
			'basic' => array(
				'title' => _p('basic_information'),
				'data' => array(
					array(
						'title' => _p('display_name'),
						'value' => (isset($aVals['full_name']) ? $aVals['full_name'] : (isset($aUser['full_name']) ? $aUser['full_name'] : '')),
						'type' => 'input:text',
						'id' => 'full_name',
						'required' => true
					),
					array(
						'title' => _p('username'),
						'value' => (isset($aVals['user_name']) ? $aVals['user_name'] : (isset($aUser['user_name']) ? $aUser['user_name'] : '')),
						'type' => 'input:text:check',
						'id' => 'user_name',
						'required' => true
					),		
					array(
						'title' => _p('password'),
						'value' => '',
						'type' => 'input:password:check',
						'id' => 'password',
						'required' => true
					),	
					array(
						'title' => _p('email'),
						'value' => (isset($aVals['email']) ? $aVals['email'] : (isset($aUser['email']) ? $aUser['email'] : '')),
						'type' => 'input:text:check',
						'id' => 'email',
						'required' => true
					),
					array(
						'title' => _p('user_group'),
						'value' => (isset($aVals['user_group_id']) ? $aVals['user_group_id'] : (isset($aUser['user_group_id']) ? $aUser['user_group_id'] : '')),
						'type' => 'select',
						'id' => 'user_group_id',
						'options' => $aUserGroups,
						'required' => true
					),
					array(
						'title' => _p('location'),
						'value' => (isset($aVals['country_iso']) ? $aVals['country_iso'] : (isset($aUser['country_iso']) ? $aUser['country_iso'] : '')),
						'type' => 'select',
						'id' => 'country_iso',
						'options' => Core_Service_Country_Country::instance()->get()
					),
					array(
						'title' => _p('city'),
						'value' => (isset($aVals['city_location']) ? $aVals['city_location'] : (isset($aUser['city_location']) ? $aUser['city_location'] : '')),
						'type' => 'input:text',
						'id' => 'city_location'						
					),		
					array(
						'title' => _p('zip_postal_code'),
						'value' => (isset($aVals['postal_code']) ? $aVals['postal_code'] : (isset($aUser['postal_code']) ? $aUser['postal_code'] : '')),
						'type' => 'input:text',
						'id' => 'postal_code'						
					),	
					array(
						'title' => _p('gender'),
						'value' => (isset($aVals['gender']) ? $aVals['gender'] : (isset($aUser['gender']) ? $aUser['gender'] : '')),
						'type' => 'select',
						'id' => 'gender',
						'options' => Core_Service_Core::instance()->getGenders(),
						'required' => true
					),
					array(
						'title' => _p('date_of_birth'),
						'type' => 'date_of_birth'						
					),
					array(
						'title' => _p('time_zone'),
						'value' => (isset($aVals['time_zone']) ? $aVals['time_zone'] : (isset($aUser['time_zone']) ? $aUser['time_zone'] : '')),
						'type' => 'select',
						'id' => 'time_zone',
						'options' => Core_Service_Core::instance()->getTimeZones()
					),
					array(
						'title' => _p('status'),
						'value' => (isset($aVals['status']) ? $aVals['status'] : (isset($aUser['status']) ? $aUser['status'] : '')),
						'type' => 'input:text',
						'id' => 'status'						
					),	
					array(
						'title' => _p('spam_count'),
						'value' => (isset($aVals['total_spam']) ? $aVals['total_spam'] : (isset($aUser['total_spam']) ? $aUser['total_spam'] : '')),
						'type' => 'input:text',
						'id' => 'total_spam'						
					),
					array(
						'title' => _p('primary_language'),
						'value' => (isset($aVals['language_id']) ? $aVals['language_id'] : (isset($aUser['language_id']) ? $aUser['language_id'] : '')),
						'type' => 'select',
						'id' => 'language_id',
						'options' => $aLanguages
					),
					array(
						'title' => _p('forum_signature'),
						'value' => (isset($aVals['signature']) ? $aVals['signature'] : (isset($aUser['signature']) ? $aUser['signature'] : '')),
						'type' => 'input:textarea',
						'id' => 'signature'
					)
				)
			)
		);		
		
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_admincp_add')) ? eval($sPlugin) : false);
		
		list($aUserPrivacy, $aNotifications, $aProfiles) = User_Service_Privacy_Privacy::instance()->get($aUser['user_id']);
		
		$this->setParam('aUser', $aUser);		
		
		$aActivityPoints = array();
		$aActivityPoints['activity_total'] = array(
			_p('total_activity') => $aUser['activity_total']
		);
		$aActivityPoints['activity_points'] = array(
			_p('total_activity_points') => $aUser['activity_points']
		);		
		
		$aMassActivityCallback = Phpfox::massCallback('getActivityPointField');
		foreach ($aMassActivityCallback as $aMassActivityCallbackModules)
		{
			foreach ($aMassActivityCallbackModules as $sName => $sValue)
			{
				$aActivityPoints[$sValue] = array(
					$sName => $aUser[$sValue]
				);					
			}
		}
		
		$aSettings = Custom_Service_Custom::instance()->getForEdit(array('user_main', 'user_panel', 'profile_panel'), $aUser['user_id'], $aUser['user_group_id'], false, $aUser['user_id']);
				
		$this->template()
			->setSectionTitle(_p('members'))
			->setTitle(_p('editing_member'))
			->setBreadCrumb(_p('browse_members'), $this->url()->makeUrl('admincp.user.browse'))
			->setBreadCrumb(($bIsEdit ? _p('editing_member') . ': ' . $aUser['full_name'] . ' (#' . $aUser['user_id'] . ')' : _p('add_new_member')), null, true)
			->setPhrase(array(
					'loading_custom_fields'
				)
			)
			->setHeader('cache', array(
					'country.js' => 'module_core'
				)
			)
			->assign(array(
					'bIsEdit' => $bIsEdit,
					'iFormUserId' => ($bIsEdit ? $aUser['user_id'] : ''),
					'aEditForm' => $aEditForm,
					'aSettings' => $aSettings,
					'aUser' => $aUser,
					'aPrivacyNotifications' => $aNotifications,
					'aProfiles' => $aProfiles,
					'aUserPrivacy' => $aUserPrivacy,
					'aActivityPoints' => $aActivityPoints,
					'sDobStart' => Phpfox::getParam('user.date_of_birth_start'),
					'sDobEnd' => Phpfox::getParam('user.date_of_birth_end')					
				)
			);		
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_admincp_add_clean')) ? eval($sPlugin) : false);
	}
}