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
 * @package 		Phpfox_Service
 * @version 		$Id: block.class.php 5591 2013-03-28 10:12:52Z Miguel_Espinoza $
 */
class User_Service_Block_Block extends Phpfox_Service 
{
	/**
	 * Class constructor
	 */	
	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('user_blocked');	
	}
	
	/**
	 * This function checks if $iUserId blocked $iBlockedUserId.
	 * We cache the $iBlockedUser (`phpfox_user_blocked`.`block_user_id`) and check 
	 * if $iUserId is in that array.
     * @param int $iUserId
     * @param int $iBlockedUserId
     * @return bool
	 */

	public function isBlocked($iUserId, $iBlockedUserId)
	{
		static $aCache = array();
        if ($iUserId === null)
        {
            $iUserId = Phpfox::getUserId();
        }

        if (!$iUserId) return false;

		if (isset($aCache[$iUserId][$iBlockedUserId])) {
			return $aCache[$iUserId][$iBlockedUserId];
		}

        $aBlockedUserIds = $this->get($iUserId, true);
        $aCache[$iUserId][$iBlockedUserId] = in_array($iBlockedUserId, $aBlockedUserIds);

		return $aCache[$iUserId][$iBlockedUserId];
	}
	
	public function get($iUserId = null, $bBothSide = false)
	{
		if ($iUserId === null)
		{
			$iUserId = Phpfox::getUserId();
		}

		if ($bBothSide) {
            $cache = $this->cache()->set('user/block/both/' . $iUserId);
            $aUserIds = $this->cache()->get($cache);
            if ($aUserIds === false) {
                $aRows = $this->database()
                    ->select('CASE ub.user_id WHEN ' . $iUserId . ' THEN ub.block_user_id ELSE ub.user_id END as block_user_id')
                    ->from($this->_sTable, 'ub')
                    ->where('ub.user_id = ' . (int) $iUserId . ' OR ub.block_user_id = ' . (int) $iUserId)
                    ->execute('getSlaveRows');
                $aUserIds = [];
                foreach ($aRows as $aRow) {
                    $aUserIds[] = $aRow['block_user_id'];
                }
                $this->cache()->save($cache, $aUserIds);
            }
            return $aUserIds;
        }
		return $this->database()->select('ub.block_user_id, ' . Phpfox::getUserField())
			->from($this->_sTable, 'ub')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = ub.block_user_id')
			->where('ub.user_id = ' . (int) $iUserId)
			->execute('getSlaveRows');		
	}
	
	/**
	 * If a call is made to an unknown method attempt to connect
	 * it to a specific plug-in with the same name thus allowing 
	 * plug-in developers the ability to extend classes.
	 *
	 * @param string $sMethod is the name of the method
	 * @param array $aArguments is the array of arguments of being passed
     * @return mixed
	 */
	public function __call($sMethod, $aArguments)
	{
		/**
		 * Check if such a plug-in exists and if it does call it.
		 */
		if ($sPlugin = Phpfox_Plugin::get('user.service_block_block__call'))
		{
			eval($sPlugin);
            return null;
		}
			
		/**
		 * No method or plug-in found we must throw a error.
		 */
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}