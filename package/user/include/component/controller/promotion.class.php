<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox_Component
 * @version 		$Id: promotion.class.php 1601 2010-05-30 05:20:59Z Raymond_Benc $
 */
class User_Component_Controller_Promotion extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		Phpfox::isUser(true);
		$aUserGroup = User_Service_Group_Group::instance()->getGroup(Phpfox::getUserBy('user_group_id'));
		$this->template()->setTitle(_p('promotions'))
			->setBreadCrumb(_p('promotions'))
			->assign(array(
				'aUserGroup' => $aUserGroup
			)
		);	
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_promotion_clean')) ? eval($sPlugin) : false);
	}
}