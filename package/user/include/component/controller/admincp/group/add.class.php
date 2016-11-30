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
 * @version 		$Id: add.class.php 6891 2013-11-15 16:37:37Z Fern $
 */
class User_Component_Controller_Admincp_Group_Add extends Phpfox_Component 
{
	/**
	 * Controller
	 */
	public function process()
	{			
		$iGroupId = $this->request()->getInt('id');		
		$sModule = $this->request()->get('module');
		
		$this->template()
			->setSectionTitle(_p('manage_user_groups'))
			->setHeader('cache', array(
				'jquery/plugin/jquery.scrollTo.js' => 'static_script'
			)
		);
		
		if ($iGroupId)
		{
            if ($this->request()->get('setting')) {
                Phpfox::getUserParam('user.can_manage_user_group_settings', true);
            } else {
                Phpfox::getUserParam('user.can_edit_user_group', true);
            }
            
            if ($aVals = $this->request()->getArray('val')) {
                if (User_Service_Group_Process::instance()->update($iGroupId, $aVals)) {
                    $this->url()->send('admincp.user.group', null, _p('user_group_updated'));
                }
            }
			
			$aGroup = User_Service_Group_Group::instance()->getGroup($iGroupId);
            
            if (Phpfox::getParam('core.allow_cdn')) {
                $aGroup['server_id'] = Phpfox::getLib('cdn')->getServerId();
            } else {
                $aGroup['server_id'] = 0;
            }
            
            if (!isset($aGroup['user_group_id'])) {
                return Phpfox_Error::display(_p('invalid_user_group'));
            }
            $this->template()->clearBreadCrumb();
			$this->template()->assign(array(
					'aModules' => User_Service_Group_Setting_Setting::instance()->getModules($iGroupId),
					'aForms' => $aGroup,
					'sModule' => $sModule,
					'iGroupId' => $iGroupId,
					'bEditSettings' => ($this->request()->get('setting') ? true : false)
				)
			)
			->setSectionTitle(_p('manage_settings') . ': ' . Phpfox_Locale::instance()->convert($aGroup['title']) . ' (ID#' . $aGroup['user_group_id'] . ')')
			->setTitle(_p('manage_settings') . ': ' . Phpfox_Locale::instance()->convert($aGroup['title']) . ' (ID#' . $aGroup['user_group_id'] . ')')
			->setBreadCrumb(_p('manage_settings') . ': ' . Phpfox_Locale::instance()->convert($aGroup['title']) . ' (ID#' . $aGroup['user_group_id'] . ')')
			->setHeader('cache', array(
					'template.css' => 'style_css'
				)
			);
		}
		else 
		{
			if ($aVals = $this->request()->getArray('val'))
			{
				if ($iId = User_Service_Group_Process::instance()->add($aVals))
				{
					$this->url()->send('admincp.user.group', null, _p('user_group_successfully_added'));
				}
			}
			
			$this->template()
				->setBreadCrumb(_p('create_new_user_group'), $this->url()->makeUrl('current'), true)
				->setTitle(_p('create_new_user_group'))
				->assign(array(
						'aGroups' => User_Service_Group_Group::instance()->get()
					)
				);
		}
        return null;
	}
}