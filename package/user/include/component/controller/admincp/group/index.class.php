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
 * @version 		$Id: index.class.php 1179 2009-10-12 13:56:40Z Raymond_Benc $
 */
class User_Component_Controller_Admincp_Group_Index extends Phpfox_Component 
{
	/**
	 * Controller
	 */
	public function process()
	{	
		$this->template()->setBreadCrumb(_p('user_groups'), $this->url()->makeUrl('admincp.user.group'))
			->setBreadCrumb(_p('manage_user_groups'), null, true)
			->setTitle(_p('manage_user_groups'))
			->setSectionTitle(_p('manage_user_groups'))
			->setActionMenu([
                _p('create_user_group') => [
					'class' => 'popup',
					'url' => $this->url()->makeUrl('admincp.user.group.add')
				]
			])
			->assign(array(
				'aGroups' => User_Service_Group_Group::instance()->getForEdit(),
			)
		);
	}
}