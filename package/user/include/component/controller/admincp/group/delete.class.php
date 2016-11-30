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
 * @version 		$Id: delete.class.php 2137 2010-11-15 13:37:06Z Raymond_Benc $
 */
class User_Component_Controller_Admincp_Group_Delete extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		Phpfox::getUserParam('user.can_delete_user_group', true);
		
		if ($aVals = $this->request()->getArray('val'))
		{
			if (User_Service_Group_Process::instance()->delete($aVals))
			{
				$this->url()->send('admincp.user.group', null, _p('successfully_deleted_user_group'));
			}
		}
		
		$aGroup = User_Service_Group_Group::instance()->getGroup($this->request()->getInt('id'));
		
		if (!isset($aGroup['user_group_id']))
		{
			return Phpfox_Error::display(_p('unable_to_find_the_user_group_you_want_to_delete'));
		}
		
		if ($aGroup['is_special'])
		{
			return Phpfox_Error::display(_p('not_allowed_to_delete_this_user_group'));
		}
		
		$this->template()
			->setTitle(_p('delete_user_group'))
			->setBreadCrumb(_p('delete_user_group'))
			->setBreadCrumb($aGroup['title'], null, true)
			->assign(array(
					'aGroup' => $aGroup,
					'aGroups' => User_Service_Group_Group::instance()->get()
				)
			);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_admincp_group_delete_clean')) ? eval($sPlugin) : false);
	}
}