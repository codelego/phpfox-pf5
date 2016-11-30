<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel_Espinoza
 * @package 		Phpfox_Component
 * @version 		$Id: featured.class.php 1666 2010-07-07 08:17:00Z Raymond_Benc $
 */
class User_Component_Block_Featured extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		list($aUsers, $iTotal) = User_Service_Featured_Featured::instance()->get();
		if (empty($aUsers) || $aUsers === false) return false;
		if (count($aUsers) < $iTotal) $this->template()->assign(array('aFooter' => array(
					_p('view_all') => $this->url()->makeUrl('user.browse', array('view' => 'featured'))
				)));
		$this->template()->assign(array(
				'aFeaturedUsers' => $aUsers,
				'sHeader' => _p('featured_members'),
			)
		);
		return 'block';
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_block_featured_clean')) ? eval($sPlugin) : false);
	}
}