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
 * @version 		$Id: ajax.class.php 6792 2013-10-16 10:19:49Z Fern $
 */
class User_Component_Ajax_Ajax extends Phpfox_Ajax
{
	public function processPurchasePoints()
	{
		Phpfox::getBlock('user.processpoints');
		$this->html('#js_purchase_points', $this->getContent(false));
	}
	
	public function purchasePoints()
	{
		$this->setTitle(_p('purchase_activity_points'));
		Phpfox::getBlock('user.purchasepoints');
	}
	
	public function updateFeedSort()
	{
		Phpfox::isUser(true);
		if (User_Service_Process::instance()->updateFeedSort($this->get('order')))
		{
			$this->call('window.location.href = \'\';');
		}
	}
	
	public function confirmEmail()
	{
		$aVals = $this->get('val');
		
		$bFailed = false;
		if (empty($aVals['email']) || empty($aVals['confirm_email']))
		{
			$bFailed = true;
		}
		else
		{
			if ($aVals['email'] != $aVals['confirm_email'])
			{
				$bFailed = true;
			}
		}
		
		if ($bFailed)
		{
			$this->show('#js_confirm_email_error');
		}
		else
		{
			$this->hide('#js_confirm_email_error');
		}
	}
	
	public function setCoverPhoto()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->updateCoverPhoto($this->get('photo_id'));
		$this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('profile', array('coverupdate' => '1')) . '\';');
	}	
	
	public function removeLogo()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->removeLogo();
		$this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('profile', array('newcoverphoto' => '1')) . '\';');
	}

	public function updateCoverPosition()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->updateCoverPosition($this->get('position'));
		$this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('profile', array('newcoverphoto' => '1')) . '\';');
	}

    public function repositionCoverPhoto(){
		Phpfox::isUser(true);
        User_Service_Process::instance()->updateCoverPosition($this->get('position'));
    }
	
	public function login()
	{
        $sMainUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        if (!empty($sMainUrl)){
            Phpfox::getLib('session')->set('redirect', $sMainUrl);
        }
		Phpfox::getBlock('user.login-ajax');
	}

	public function search()
	{
		$sId = $this->get('id');
		$aValue = $this->get('val');
		if (!isset($aValue[$sId]))
		{
			return false;
		}
		$sValue = $aValue[$sId][0];
		$sOld = $this->get('old');

		if (strpos($sValue, ','))
		{
			$aValues = explode(',', $sValue);
			$iCnt = (count($aValues) - 1);
			$sValue = trim($aValues[$iCnt]);
		}

		if (trim($sValue) == '')
		{
			$this->call("oInlineSearch.close('" . $this->get('id') . "');");
			return false;
		}

		$aRows = User_Service_User::instance()->getInlineSearch($sValue, $sOld);

		if (count($aRows))
		{
			Phpfox_Template::instance()->assign(array(
					'aRows' => $aRows,
					'sJsId' => $this->get('id'),
					'sSearch' => $this->get('value'),
					'bIsUser' => true
				)
			)->getLayout('inline-search');

			$this->call("oInlineSearch.display('" . $this->get('id') . "', '" . $this->getContent() . "');");
		}
        return null;
	}
	
	public function showUserName()
	{
		Phpfox_Ajax::error(false);
		
		$aVal = $this->get('val');		
		
		$aVal['user_name'] = str_replace(' ', '_', $aVal['user_name']);
		
		if (Phpfox_Validator::instance()->verify('username', $aVal['user_name']))
		{
            User_Service_Validate::instance()->user($aVal['user_name']);

			if (Phpfox_Error::isPassed())
			{
				$this->call('$(\'#js_signup_user_name\').html(\'<span style="color:green; font-weight:bold;">' . htmlentities(addslashes($aVal['user_name'])) . '</span>\');');

				return true;
			}
		}		
		$this->call('$(\'#js_signup_user_name\').html(\'<span style="color:red; font-weight:bold;">' . htmlentities(addslashes($aVal['user_name'])) . '</span>\');');
        return null;
	}

	public function searchUserName($aVal = null)
	{
		Phpfox_Ajax::error(false);
		
		if ($aVal === null)
		$aVal = $this->get('val');		
		
		$aVal['user_name'] = str_replace(' ', '_', $aVal['user_name']);
	
		if (Phpfox_Validator::instance()->verify('username', $aVal['user_name']))
		{
            User_Service_Validate::instance()->user($aVal['user_name']);

			if (Phpfox_Error::isPassed())
			{
				$this->call('$(\'#js_user_url_name\').html(\'<span style="color:green; font-weight:bold;">' . htmlentities(addslashes($aVal['user_name'])) . '</span>\');');
				$this->html('#js_user_name_error_message', '');

				return true;
			}
		}		
		$this->call('$(\'#js_user_url_name\').html(\'<span style="color:red; font-weight:bold;">' . htmlentities(addslashes($aVal['user_name'])) . '</span>\');');

		return false;
	}
	
	public function clearStatus()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->clearStatus(Phpfox::getUserId());
		
		$this->call('var sParsed = $("<div/>").html(\'' . _p('what_is_on_your_mind') . '\').text();$("#js_global_status_input").val(sParsed);$("#js_status_input").val(sParsed);');
		$this->hide('#js_update_user_status_button')
			->show('#js_current_user_status')
			->hide('.user_status_update_ajax')
			->html('.js_actual_user_status_' . Phpfox::getUserId(), '')
			->html('.js_actual_user_status_bar_' . Phpfox::getUserId(), '');
	}
	
	public function updateStatus()
	{
		Phpfox::isUser(true);
		$aVals = (array) $this->get('val');
		if (isset($aVals['user_status']) && ($iId = User_Service_Process::instance()->updateStatus($aVals))) {
            if (isset($aVals['feed_id'])){
                //Mean edit already status
                Feed_Service_Feed::instance()->processUpdateAjax($aVals['feed_id']);
            } else {
                //Mean add new status
                (($sPlugin = Phpfox_Plugin::get('user.component_ajax_updatestatus')) ? eval($sPlugin) : false);
                Feed_Service_Feed::instance()->processAjax($iId);
            }
		} else {
			$this->call('$Core.activityFeedProcess(false);');
		}
	}
	
	public function mainBrowse()
	{
		Phpfox::getComponent('user.browse', array(), 'controller');
		
		$this->remove('.js_pager_view_more_link');
		$this->call("if($('#js_view_more_users').length == 0) { $('#delayed_block').append('<div id=\"js_view_more_users\"></div>'); } ");
		$this->append('#js_view_more_users', $this->getContent(false));
		$this->call('$Core.loadInit();');				
	}
	
	public function browse()
	{
		if ($this->get('bIsAdminCp')) {
			Phpfox::setAdminPanel();
		}
		Phpfox::getBlock('user.browse', array('input' => $this->get('input'), 'bIsAdminCp' => $this->get('bIsAdminCp')));
		$this->call('<script type="text/javascript">$(\'#TB_ajaxWindowTitle\').html(\'' . _p('search_for_members', array('phpfox_squote' => true)) . '\');</script>');
	}
	
	public function browseAjax()
	{
		if ($this->get('bIsAdminCp')) {
			Phpfox::setAdminPanel();
		}
		Phpfox::getBlock('user.browse', array('page' => $this->get('page'), 'find' => $this->get('find'), 'input' => $this->get('input'), 'is_search' => true, 'bIsAdminCp' => $this->get('bIsAdminCp')));
		
		$this->call('$(\'#js_user_search_content\').html(\'' . $this->getContent() . '\'); updateCheckBoxes();');
	}

	/**
	 * Shows the deleteUser block, does not perform  the actual delete
	 */
        public function deleteUser()
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('admincp.has_admin_access', true);
		Phpfox::getUserParam('user.can_delete_others_account', true);
		$iUser = (int)$this->get('iUser');
		Phpfox::getBlock('user.admincp.deleteUser', array('iUser' => $iUser));
	}

	/**
	 * Deletes a feedback from the admin panel
	 */
	public function deleteFeedback()
	{
		Phpfox::isAdmin(true);
		$iFeedback = (int)$this->get('iFeedback');
		if (User_Service_Cancellations_Process::instance()->deleteFeedback($iFeedback))
		{
			$this->call('$("#js_feedback_'.$iFeedback.'").remove();');
		}
		else
		{
			$this->alert(_p('we_found_a_problem_with_your_request_please_try_again'));
		}
	}

	public function confirmedDelete()
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('admincp.has_admin_access', true);
		$iUser = (int)$this->get('iUser');
		
		if (!User_Service_User::instance()->isAdminUser($iUser))
		{		
			User_Service_Auth::instance()->setUserId($iUser);
			Phpfox::massCallback('onDeleteUser', $iUser);
			User_Service_Auth::instance()->setUserId(null);
			$this->call('$("#js_user_'.$iUser.'").remove();');
			$this->setMessage('User ' . $iUser . ' deleted.');
		}
		else 
		{
			Phpfox_Error::set(_p('you_are_unable_to_delete_a_site_administrator'));
		}
	}
	
	public function getRegistrationStep()
	{		
		$this->error(false);
		
		$aVals = $this->get('val');		
				
		$oValid = Phpfox_Validator::instance()->set(array('sFormName' => 'js_form', 'aParams' => User_Service_Register::instance()->getValidation($this->get('step'))));
		
		if ($this->get('step') == '1')
		{
			if (!Phpfox::getParam('user.profile_use_id') && (Phpfox::getParam('user.disable_username_on_sign_up') != 'full_name'))
			{
				$aVals['user_name'] = str_replace(' ', '_', $aVals['user_name']);
                User_Service_Validate::instance()->user($aVals['user_name']);
			}
            
            User_Service_Validate::instance()->email($aVals['email']);
		}
		
		if ($oValid->isValid($aVals))
		{		
			if ($this->get('last'))
			{
				$this->call('$(\'#js_form\').submit();');
			}
			else 
			{
				(($sPlugin = Phpfox_Plugin::get('user.component_ajax_getregistrationstep_pass')) ? eval($sPlugin) : false);
				
				if (!isset($bSkipAjaxProcess))
				{
					$this->template()->assign(array(
                        'aTimeZones' => Core_Service_Core::instance()->getTimeZones(),
                        'aPackages' => Phpfox::isModule('subscribe') ? Subscribe_Service_Subscribe::instance()->getPackages(true) : null,
                        'aSettings' => Custom_Service_Custom::instance()->getForEdit(array('user_main', 'user_panel', 'profile_panel'), null, null, true),
                        'sDobStart' => Phpfox::getParam('user.date_of_birth_start'),
                        'sDobEnd' => Phpfox::getParam('user.date_of_birth_end'),
                        'bIsBlockSignUp' => (isset($aVals['block_signup']) ? true : false)
						)
					)->getTemplate('user.block.register.step' . ($this->get('step') + 1));
				
					$this->val('#js_registration_submit', html_entity_decode(_p('continue'), null, 'UTF-8'));
					$this->call('$Core.registration.updateForm(\'' . $this->getContent() . '\');');
					if ($this->get('next'))
					{
						$this->call('$Core.registration.showCaptcha();');
					}
				}
			}
		}
		else 
		{
			$sErrors = '';
			foreach (Phpfox_Error::get() as $sError)
			{
				$sErrors .= '<div class="error_message">' . $sError . '</div>';
			}
			
			if ($this->get('step') == '1')
			{
				$this->call('$(\'#js_register_accept\').show();');
			}
			
			$this->call('$(\'#js_registration_process\').hide();$(\'#js_registration_holder\').show();')->html('#js_signup_error_message', $sErrors);
		}
		
		$this->call('$Core.loadInit();');
	}
	
	public function getNew()
	{
		Phpfox::getBlock('user.new');
		
		$this->html('#' . $this->get('id'), $this->getContent(false));
		$this->call('$(\'#' . $this->get('id') . '\').parents(\'.block:first\').find(\'.bottom li a\').attr(\'href\', \'' . Phpfox_Url::instance()->makeUrl('user.browse', array('sort' => 'joined')) . '\');');
	}	
	
	public function getAccountSettings()
	{
		Phpfox::getBlock('user.setting');
		
		$this->hide('#js_basic_info_data')
			->hide('#js_user_basic_info')
			->show('#js_user_basic_edit_link')
			->html('#js_basic_info_form', $this->getContent(false))
			->show('#js_basic_info_form');
	}
	
	public function updateAccountSettings()
	{		
		$aValidation = array(					
			'country_iso' => _p('select_current_location')
		);	

		if (Phpfox::getUserParam('user.can_edit_gender_setting'))
		{
			$aValidation['gender'] = _p('select_your_gender');
		}
		
		if (Phpfox::getUserParam('user.can_edit_dob'))
		{
			$aValidation['month'] = _p('select_month_of_birth');
			$aValidation['day'] = _p('select_day_of_birth');
			$aValidation['year'] = _p('select_year_of_birth');
		}	
		
		$oValid = Phpfox_Validator::instance()->set(array('sFormName' => 'js_form', 'aParams' => $aValidation));
		
		if (!$oValid->isValid($this->get('val')))
		{
			$this->hide('#js_updating_basic_info_load')->show('#js_updating_basic_info');
			
			return false;				
		}
		
		if (User_Service_Process::instance()->updateSimple(Phpfox::getUserId(), $this->get('val')))
		{
					
		}		
		
		if (Custom_Service_Process::instance()->updateFields(Phpfox::getUserId(), Phpfox::getUserId(), $this->get('custom')))
		{
			
		}
		
		Phpfox::getBlock('profile.info');
		
		$this->hide('#js_updating_basic_info_load')->show('#js_updating_basic_info');
		$this->hide('#js_basic_info_form')
			->html('#js_basic_info_data', $this->getContent(false))
			->show('#js_basic_info_data')
			->call('$Core.rate.init({display: false, error_message: \'' . _p('you_cannot_rate_your_own_profile', array('phpfox_squote' => true)) . '\'});');
	}
	
	public function updateFooterBar()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->updateFooterBar(Phpfox::getUserId(), $this->get('type_id'));
	}
	
	public function hideBlock()
	{
		Phpfox::isUser(true);
        User_Service_Process::instance()->hideBlock($this->get('block_id'));
	}

	public function verifyUsername()
	{
        if (!Phpfox::getParam('user.suggest_usernames_on_registration'))
		{
        	return false;
		}
                
		$aUser = array('user_name' => $this->get('user_name'));
		
		$aUser['user_name'] = str_replace(' ', '_', $aUser['user_name']);
		
		Phpfox_Validator::instance()->verify('username', $aUser['user_name']);
		
		if (!Phpfox_Error::isPassed())
		{			
			return false;
		}		
		
		if ($this->searchUserName($aUser))
		{
			// this username is valid
			$this->html('#js_verify_username', '<div class="valid_message">' . _p('this_username_is_available') . '</div>')->show('#js_verify_username');
		}
		else
		{		
			// get X suggestions as user names and check them
			$iFailedTries = 0;
			$aValidNames = array();			
			// filter the username so it only allows a-z, A-Z, numbers, dash (-) and underscore (_)
			$sValidUsername = '';
			if (strlen($aUser['user_name']) > 0)
			{
				for($i = 0; $i < strlen($aUser['user_name']); $i++)
				{
					if(preg_match('/[-a-zA-Z0-9_]/i', $aUser['user_name'][$i]) !== false)
					{
						$sValidUsername .= $aUser['user_name'][$i];
					}
				}
			}
			$aSuggestedNames = Phpfox::getParam('user.usernames_to_suggest');
			$aSuggestedNames[] = $sValidUsername;
			
			// check user.validate --> eregi("[a-zA-Z] use this to get the valid part of the username and generate the new user names
			$iRand = rand(100, 999);
			while ( count($aValidNames) < Phpfox::getParam('user.how_many_usernames_to_suggest'))
			{
				$sTry = $aSuggestedNames[array_rand($aSuggestedNames)] . $iRand;
				if (Phpfox_Validator::instance()->verify('username', $sTry)
					&& Phpfox::getLib('parse.input')->allowTitle($sTry, 'Username is already in use.')
					&& Ban_Service_Ban::instance()->check('username', $sTry)
				)
				{
					$aValidNames[] = $sTry;
					$iRand = rand(100, 999);
				}
				elseif ($iFailedTries < 2)
				{
					// missed once, we increment the random value
					$iRand = rand(100, 9999);
					$iFailedTries++;
				}
				else
				{
					// ok now its too many
					break;
				}				
			}			
			
			Phpfox::getBlock('user.signup-error', array('aNames' => $aValidNames));
			
			$this->html('#js_verify_username', $this->getContent(false))->show('#js_verify_username');			
		}
        return null;
	}
	
	public function loadCustomField()
	{
		Phpfox::getBlock('user.custom');	
		
		$this->html('#js_custom_field_holder', $this->getContent(false));
	}	
	
	public function changePicture()
	{
		Phpfox::getBlock('user.photo');	
	}	
	
	public function block()
	{
		Phpfox::getBlock('user.block');
	}
	
	public function processBlock()
	{		
		if (User_Service_Block_Process::instance()->add($this->get('user_id')))
		{
			$this->setMessage(_p('user_successfully_blocked'));
            $this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('user.privacy.blocked') . '\';');
		}
	}
	
	public function unBlock()
	{
		if (User_Service_Block_Process::instance()->delete($this->get('user_id')))
		{
			$this->setMessage(_p('user_successfully_unblocked'));
		}		
	}

	/**
	 * Handles featuring and un-featuring a user, permissions are checked on the service itself
	 */
	public function feature()
	{
		$iUser = intval($this->get('user_id'));
		$bFeature = $this->get('feature');
		if ($bFeature == 1 || $bFeature == 0)
		{
			if ($bFeature == 1 && (User_Service_Featured_Process::instance()->feature($iUser))) // trying to feature
			{
				if ($this->get('type') != '1')
				{
					$sNewHtml = '<a href=\"#\" onclick=\"$.ajaxCall(\'user.feature\', \'user_id='.$iUser.'&feature=0\'); return false;\">' . _p('unfeature_user');
					$this->call('$(".js_feature_'.$iUser.'").html("'.$sNewHtml.'");');
				}

				return true;
			}
			elseif($bFeature == 0 && (User_Service_Featured_Process::instance()->unfeature($iUser)))
			{
				if ($this->get('type') != '1')
				{
					$sNewHtml = '<a href=\"#\" onclick=\"$.ajaxCall(\'user.feature\', \'user_id='.$iUser.'&feature=1\'); return false;\">' . _p('feature_user');
					$this->call('$(".js_feature_'.$iUser.'").html("'.$sNewHtml.'");');
				}				

				if ($this->get('view') == 'featured')
				{
					$this->hide('#js_parent_user_' . $iUser);
				}				
				
				return true;
			}
			
			
		}// else potential hack attempt		
		
		$this->alert(_p('an_error_occured_and_this_operation_was_not_completed')); // potential hack attempt
		
		return false;
	}

	/**
	 * Changes the order of a  member
	 */
	public function setFeaturedOrder()
	{
		Phpfox::isAdmin(true);
		if (User_Service_Featured_Process::instance()->updateOrder($this->get('val')))
		{
			
		}
	}

	/**
	 * Verifies a username so the user can log in.
	 */
	public function verifyEmail()
	{
		$iUser = $this->get('iUser');
		$bVerified = User_Service_Verify_Process::instance()->adminVerify($iUser);
		if ($bVerified == true)
		{
			$this->call('$(".js_verify_email_'.$iUser.'").hide("slow", function(){$(this).remove();});');
		}
		else
		{
			$this->alert(_p('an_error_occured_and_this_user_could_not_be_verified'));
		}
	}

	/**
	 * Sends an email to the user_id with with the verification  link
	 */
	public function verifySendEmail()
	{
		$iUser = $this->get('iUser');
		$bSent = User_Service_Verify_Process::instance()->sendMail($iUser);
		if ($bSent)
		{
			$this->alert(_p('verification_email_sent'));
			return true;
		}

		$this->alert(_p('an_error_occured_and_the_email_could_not_be_sent'));
		return false;
	}
	
	public function cropPhoto()
	{
		if ($this->get('crop')){
		  $this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('profile') . '\';');
		  return true;
		}

		Phpfox::isUser(true);

		if ($this->get('in_process'))
		{
			$oImage = Phpfox_Image::instance();
			$sFileName = $this->get('in_process');
			$aImages = array();
			if (($sPhotos = $this->get('photos')))
			{
				$aImages = unserialize(base64_decode(urldecode($this->get('photos'))));	
			}
			
			$iNotCompleted = 0;
			foreach(Phpfox::getParam('user.user_pic_sizes') as $iSize)
			{
				if (isset($aImages[sprintf($sFileName, '_' . $iSize)]))
				{
					continue;
				}
				
				if (Phpfox::getParam('core.keep_non_square_images'))
				{
					$oImage->createThumbnail(Phpfox::getParam('core.dir_user') . sprintf($sFileName, ''), Phpfox::getParam('core.dir_user') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
				}
				$oImage->createThumbnail(Phpfox::getParam('core.dir_user') . sprintf($sFileName, ''), Phpfox::getParam('core.dir_user') . sprintf($sFileName, '_' . $iSize . '_square'), $iSize, $iSize, false);
				
				$aImages[sprintf($sFileName, '_' . $iSize)] = true;
				
				$iNotCompleted++;
				
				$this->call('p(\'Processing photo: ' . sprintf($sFileName, '_' . $iSize) . '\');');
				
				break;
			}

			$sValues = '';
			foreach ($this->get('val') as $sKey => $mValue)
			{
				$sValues .= '&val[' .$sKey . ']=' . urlencode($mValue);
			}				
			
			if ($iNotCompleted)
			{
				$this->call('$.ajaxCall(\'user.cropPhoto\', \'js_disable_ajax_restart=true&photos=' . urlencode(base64_encode(serialize($aImages))) . '&in_process=' . $this->get('in_process') . '&file=' . $this->get('in_process') . '' . $sValues . '\');');
			}
			else 
			{
				$oFile = Phpfox_File::instance();
				
				$iServerId = Phpfox_Request::instance()->getServer('PHPFOX_SERVER_ID');
				
				$this->call('p(\'Completed resizing photos.\');');
				
				if (Phpfox::getUserBy('user_image') != '')
				{			
					if (file_exists(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), '')))
					{
						$oFile->unlink(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), ''));
						foreach(Phpfox::getParam('user.user_pic_sizes') as $iSize)
						{
							if (file_exists(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), '_' . $iSize)))
							{
								$oFile->unlink(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), '_' . $iSize));
							}
							
							if (file_exists(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), '_' . $iSize . '_square')))
							{
								$oFile->unlink(Phpfox::getParam('core.dir_user') . sprintf(Phpfox::getUserBy('user_image'), '_' . $iSize . '_square'));
							}					
						}
					}
				}				

				$sFileName = $this->get('file');
				
				Phpfox_Database::instance()->update(Phpfox::getT('user'), array('user_image' => $sFileName, 'server_id' => $iServerId), 'user_id = ' . Phpfox::getUserId());

				(Phpfox::isModule('feed') ? Feed_Service_Process::instance()->delete('user_photo', Phpfox::getUserId()) : null);
				(Phpfox::isModule('feed') ? Feed_Service_Process::instance()->add('user_photo', Phpfox::getUserId(), serialize(array('destination' => $sFileName, 'server_id' => $iServerId))) : null);
				
				$this->call('$.ajaxCall(\'user.cropPhoto\', \'crop=true&js_disable_ajax_restart=true' . $sValues . '\');');
				if (Phpfox::isModule('photo'))
				{
                    Photo_Service_Album_Album::instance()->getForProfileView(Phpfox::getUserId(), true);
				}
			}
			
			return null;
		}
		
        $this->call('p(\'Cropping photo.\');');
        if (User_Service_Process::instance()->cropPhoto($this->get('val')))
        {
                Phpfox::addMessage(_p('profile_photo_successfully_updated'));

                Phpfox::setCookie('recache_image', 'yes', (PHPFOX_TIME + 600));

                $this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('profile') . '\';');
        }
        else
        {
            $this->show('#js_photo_preview_ajax')->html('#js_photo_preview_ajax', '');
        }
        return null;
	}
	
	public function changePassword()
	{
		Phpfox::getBlock('user.password');
	}
	
	public function updatePassword()
	{
		$this->error(false);
		
		if (User_Service_Process::instance()->updatePassword($this->get('val')))
		{
			Phpfox::addMessage(_p('password_successfully_updated'));
			
			$this->call('window.location.href = \'' . Phpfox_Url::instance()->makeUrl('user.setting') . '\';');
		}
		else 
		{
			$this->html('#js_progress_cache_loader', '<div class="error_message">' . implode('', Phpfox_Error::get()) . '</div>');
		}
	}
	
	public function checkSpaceUsage()
	{
		$this->error(false);
		Phpfox::isUser(true);
		if (User_Service_Space::instance()->isAllowedToUpload(Phpfox::getUserId()))
		{
			
		}
		else 
		{
			$this->html('#js_progress_cache_loader', '<div class="error_message">' . implode('', Phpfox_Error::get()) . '</div>');
			$this->hide('#' . $this->get('holder'));
			$this->show('#js_progress_cache_loader');
		}
	}	
	
	public function browseMethod()
	{
		if ($this->get('type') == 'advanced')
		{
			$this->show('#js_user_browse_advanced');
		}
		else 
		{
			$this->hide('#js_user_browse_advanced')->val('.js_custom_search', '');
		}
	}
	
	public function ban()
	{
		if (User_Service_Process::instance()->ban($this->get('user_id'), $this->get('type')))
		{
			if ($this->get('type') == 1)
			{
				Phpfox::addMessage(_p('this_user_has_been_banned'));
			}
			else
			{
				Phpfox::addMessage(_p('this_user_has_been_unbanned'));
			}
			$this->call("window.location.reload(true);");
		}
	}
	
	public function getSettings()
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('admincp.has_admin_access', true);
		Phpfox::getBlock('user.admincp.setting');
		
		$this->html('#js_module_title', $this->get('module_id'));
		$this->html('#js_setting_block', $this->getContent(false));
		$this->show('#content_editor_text');
		
		$this->addClass('.table_clear', 'table_hover_action');
		$this->call('$.scrollTo(0);');
		$this->call('$Core.loadInit();');
	}
	
	public function updateSettings()
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('admincp.has_admin_access', true);
		
		$aVals = $this->get('val');
		foreach ($this->get('param') as $iId => $sVar)
		{
			$aVals['param'][$iId] = $sVar;
		}
		if (User_Service_Group_Setting_Process::instance()->update($this->get('id'), $aVals))
		{
			$this->call('$Core.closeAjaxMessage();');
		}
	}
    
    /**
     * Todo This function might not use anymore
     */
	public function deleteGroupIcon()
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('admincp.has_admin_access', true);
		
		if (User_Service_Group_Setting_Process::instance()->deleteIcon($this->get('group_id')))
		{
			
		}		
	}
	
	public function processUploadedImage()
	{
		
	}
	
	public function userPending()
	{
		Phpfox::isAdmin(true);
		
		if (($aUser = User_Service_Process::instance()->userPending($this->get('user_id'), $this->get('type'))))
		{			
			$this->remove('.js_user_pending_' . $this->get('user_id'));
			if ($this->get('type') == '1')
			{
				$this->html('#js_user_pending_group_' . $this->get('user_id'), $aUser['user_group_title']);
				if ($this->get('return') == true)
				{ // early return
					return true;
				}
				$this->alert(_p('user_successfully_approved'));
			}
			else 
			{
				$this->html('#js_user_pending_group_' . $this->get('user_id'), _p('not_approved'));
				if ($this->get('return') == true)
				{ // early return
					return true;
				}
				$this->alert(_p('user_successfully_denied'));
			}
			return true;
		}
		return false;
	}

	/**
	 * Shows the "pop up" when denying a user from the adminCP
	 */
	public function showDenyUser()
	{
		Phpfox::isAdmin(true);		
		$iUser = (int)$this->get('iUser');
		Phpfox::getBlock('user.admincp.denyUser', array('iUser' => $iUser));
	}
	
	public function denyUser()
	{
		$sMessage = $this->get('sMessage');
		$sSubject = $this->get('sSubject');
		$iUser = $this->get('iUser');
		$bReturn = (bool)$this->get('doReturn');
		
		$this->set(array('user_id' => $iUser, 'type' => 2));
		if (!empty($bReturn) && $bReturn == true)
		{
			$this->set('return', true);
		
			$this->userPending();
			return true;
		}

		
		// send the email
		Phpfox::getLib('mail')->to($iUser)
				->subject($sSubject)
				->message($sMessage)
				->send();
		
		if ($this->userPending())
		{
			$this->call('$("#sFeedbackDeny").html("'._p('user_successfully_denied').'").show();');
			$this->call('setTimeout("tb_remove();",2000);');
		}
	}
	
	public function tooltip()
	{				
		Phpfox::getBlock('user.tooltip');
		
		$this->html('#js_user_tool_tip_cache_' . $this->get('user_name'), $this->getContent(false));
		$this->call('$Core.loadUserToolTip(\'' . $this->get('user_name') . '\');');
		if (Phpfox::getParam('core.defer_loading_user_images'))
		{
			$this->call('$Behavior.defer_images();');
		}
    $this->call('$Behavior.globalInit();');
	}
	
	public function addInactiveJob()
	{
		Phpfox::isAdmin(true);
		$iId = User_Service_Process::instance()->addInactiveJob($this->get('iDays'), $this->get('iBatchSize'));
		if ($iId == false)
		{
			$sErr = implode('.', Phpfox_Error::get());
			$this->alert($sErr);
			return false;
		}
		$this->html('#progress', _p('processing_batch_number',array('number' => 1)));
		$this->call('startJob('.$iId.');');
		$this->call('processJob('.$iId.');');
	}
	
	public function processJob()
	{
		Phpfox::isAdmin(true);
		$aInfo = User_Service_Process::instance()->processInactiveJob($this->get('iJobId'));
		if (isset($aInfo['iPercentage']) && $aInfo['iPercentage'] < 100)
		{
			$this->call('setTimeout("processJob('.$this->get('iJobId').')",3000);');
		}
		else
		{
			$this->call('jobCompleted();');
		}
		
		$this->html('#progress', _p('batch_number_completed_percentage', array('page_number' => $aInfo['page_number'], 'percentage' => $aInfo['iPercentage'])));
	}

	public function getInactiveMembersCount()
	{
		Phpfox::isAdmin(true);
		$iCount = User_Service_User::instance()->getInactiveMembersCount($this->get('iDays'));
		$this->html('#progress', _p('there_are_a_total_of_icount_inactive_members', array('iCount' => $iCount)));
	}	
	
	public function deleteSpamQuestion()
	{
		Phpfox::isAdmin(true);
		if (User_Service_Process::instance()->deleteSpamQuestion($this->get('iQuestionId')) )
		{
			$this->softNotice(_p('question_deleted_succesfully'));
			$this->remove('#tr_new_question_' . $this->get('iQuestionId'));
		}
	}
	
	public function saveMyLatLng()
	{
		if ($this->get('lat') == '0' && $this->get('lng') == '0')
		{
			return;
		}
        User_Service_Process::instance()->saveMyLatLng(array('latitude' => $this->get('lat'), 'longitude' => $this->get('lng') ) );
	}
}