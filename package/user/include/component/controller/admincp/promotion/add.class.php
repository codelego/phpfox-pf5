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
 * @version 		$Id: add.class.php 1601 2010-05-30 05:20:59Z Raymond_Benc $
 */
class User_Component_Controller_Admincp_Promotion_Add extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$bIsEdit = false;
		if (($iId = $this->request()->getInt('id')) && ($aPromotion = User_Service_Promotion_Promotion::instance()->getPromotion($iId)))
		{
			$bIsEdit = true;			
			$this->template()->assign(array(
					'aForms' => $aPromotion
				)
			);
		}
		
		if (($aVals = $this->request()->getArray('val')))
		{
			if ($bIsEdit)
			{
				if (User_Service_Promotion_Process::instance()->update($aPromotion['promotion_id'], $aVals))
				{
					$this->url()->send('admincp.user.promotion.add', array('id' => $aPromotion['promotion_id']), _p('promotion_successfully_update'));
				}				
			}
			else 
			{
				if (User_Service_Promotion_Process::instance()->add($aVals))
				{
					$this->url()->send('admincp.user.promotion', null, _p('promotion_successfully_added'));
				}
			}
		}
		
		$this->template()
			->setSectionTitle(_p('promotions'))
			->setTitle(($bIsEdit ? _p('editing_promotion') : _p('add_promotion')))
			->setBreadCrumb(_p('promotions'), $this->url()->makeUrl('admincp.user.promotion'))
			->setBreadCrumb(($bIsEdit ? _p('editing_promotion') : _p('add_promotion')), null, true)
			->assign(array(
					'bIsEdit' => $bIsEdit,
					'aUserGroups' => User_Service_Group_Group::instance()->get(),
					'sEnableOptionLink' => $this->url()->makeUrl('admincp.setting.edit', array('module-id' => 'user'))
				)
			);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_admincp_promotion_add_clean')) ? eval($sPlugin) : false);
	}
}