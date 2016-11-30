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
 * @version 		$Id: index.class.php 1068 2009-09-24 09:27:36Z Miguel_Espinoza $
 */
class User_Component_Controller_Admincp_Spam extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		
		if ( ($aVals = $this->request()->getArray('val')))
		{
			if (isset($aVals['question_id']))
			{
				if (User_Service_Process::instance()->editSpamQuestion($aVals))
				{
				}
			}
			else if (User_Service_Process::instance()->addSpamQuestion($aVals))
			{
			}
		}
		
		$aOut = array();
		$aOut['questions'] = User_Service_User::instance()->getSpamQuestions();
		
		if ( ($iQuestionId = $this->request()->getInt('id')))
		{
			foreach ($aOut['questions'] as $aQuestion)
			{
				if ($aQuestion['question_id'] == $iQuestionId)
				{
					$aOut['edit'] = $aQuestion;
				}
			}
		}		
		
		$jOut = json_encode($aOut);
		
		$this->template()
				->setBreadCrumb(_p('anti_spam_security_questions'))
				->setTitle(_p('anti_spam_security_questions'))
				->setSectionTitle(_p('anti_spam_questions'))
				->assign(array('sSiteUsePhrase' => $this->url()->makeUrl('admincp.language.phrase.add', array('last-module' => 'user'))))
				->setHeader(array(
					'admin.spam.js' => 'module_user',
					'admin.spam.css' => 'module_user',
					'<script type="text/javascript">$Behavior.initSpamQuestions = function(){$Core.User.Spam.initAdd();};</script>',
					'<script type="text/javascript">$Behavior.initData = function(){$Core.User.Spam.initPopulate('. $jOut .');};</script>'
				))
				->setPhrase(array(
					'setting_require_all_spam_questions_on_signup',
					'edit_question'
				));
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_index_clean')) ? eval($sPlugin) : false);
	}
}