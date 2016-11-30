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
 * @version 		$Id: index.class.php 1601 2010-05-30 05:20:59Z Raymond_Benc $
 */
class User_Component_Controller_Admincp_Promotion_Index extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		if (($iDeleteId = $this->request()->getInt('delete')) && User_Service_Promotion_Process::instance()->delete($iDeleteId))
		{
			$this->url()->send('admincp.user.promotion', null, _p('promotion_successfully_deleted'));
		}
		
		$this->template()
			->setSectionTitle(_p('promotions'))
			->setActionMenu([
				_p('create_a_promotion') => $this->url()->makeUrl('admincp.user.promotion.add')
			])
			->setTitle(_p('promotions'))
			->setBreadCrumb(_p('promotions'), $this->url()->makeUrl('admincp.user.promotion'))
			->assign(array(
					'aPromotions' => User_Service_Promotion_Promotion::instance()->get()
				)
			);		
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_admincp_promotion_index_clean')) ? eval($sPlugin) : false);
	}
}