<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * User Settings
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			natio
 * @package  		Module_User
 * @version 		$Id: photo.class.php 6532 2013-08-29 11:15:56Z Raymond_Benc $
 */
class User_Component_Controller_Photo extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		Phpfox::isUser(true);

		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");		
		
		list($bIsRegistration, $sNextUrl) = $this->url()->isRegistration(3);
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_photo_1')) ? eval($sPlugin) : false);

		$bIsProcess = false;		
		if ($this->request()->get('req3') == 'process')
		{
			$bIsProcess = true;
		}

		if (isset($_SERVER['HTTP_X_FILE_NAME'])) {
			define('PHPFOX_HTML5_PHOTO_UPLOAD', true);
		}

		(($sPlugin = Phpfox_Plugin::get('user.component_controller_photo_2')) ? eval($sPlugin) : false);

		if ((($aVals = $this->request()->getArray('val')) || isset($_SERVER['HTTP_X_FILE_NAME'])))
		{
            if (isset($aVals['crop-data'])){
                $iUserId = Phpfox::getUserId();
                $sFileName = base64_decode($this->request()->get('token'));
                if (!empty($sFileName)){
                    $sImage = Phpfox::getParam('core.dir_user') . sprintf($sFileName, '');
                    if (file_exists($sImage)){
                        $aUserImage = User_Service_Process::instance()->uploadImage($iUserId, true, $sImage);
                    }
                }
                if (empty($aVals['crop-data'])){
                    $this->url()->send('profile');
                }
                $sTempPath = PHPFOX_DIR_CACHE . md5('user_avatar' . Phpfox::getUserId()) . '.png';
                list($type, $data) = explode(';', $aVals['crop-data']);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                file_put_contents($sTempPath, $data);
                $oImage = Phpfox_Image::instance();
                if (isset($aUserImage) && isset($aUserImage['user_image'])){
                    $sUserImage = $aUserImage['user_image'];
                } else {
                    $sUserImage = Phpfox::getUserBy('user_image');
                }
                foreach (Phpfox::getParam('user.user_pic_sizes') as $iSize) {
                    if (Phpfox::getParam('core.keep_non_square_images')) {
                        $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize), $iSize, $iSize);
                    }
                    $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize . '_square'), $iSize, $iSize, false);
                }
                @unlink($sTempPath);
                $this->url()->send('profile');
            } else {
                $aImage = Phpfox_File::instance()->load('image', array('jpg', 'gif', 'png'), (Phpfox::getUserParam('user.max_upload_size_profile_photo') === 0 ? null : (Phpfox::getUserParam('user.max_upload_size_profile_photo') / 1024)));
                if (!isset($_FILES['image'])) {
                    error('Missing image.');
                }
            }

			if (isset($_SERVER['HTTP_X_FILE_NAME']) && !Phpfox_Error::isPassed()) {
				$sErrors = '';
				foreach (Phpfox_Error::get() as $sError)
				{
					$sErrors .= $sError;
				}
				return [
						'run' => 'changingProfilePhoto();window.parent.sCustomMessageString = \''.$sErrors.'\';tb_show(\'Error\', $.ajaxBox(\'core.message\', \'height=150&width=300\'));'
				];
			}
            if (!isset($aVals['is_iframe']) && Phpfox::getUserParam('user.force_cropping_tool_for_photos') && isset($aImage['name']) && !empty($aImage['name'])){
                $iUserId = Phpfox::getUserId();
                //Save to temp dir
                $sFileName = Phpfox_File::instance()->upload('image', Phpfox::getParam('core.dir_user'), md5('profile_temp_' . $iUserId), false);
                $token = [
                    'token' => base64_encode($sFileName)
                ];
                if (isset($_SERVER['HTTP_X_FILE_NAME'])) {
                    return [
                        'redirect' => $this->url()->makeUrl('user.photo.process', $token)
                    ];
                }
                $this->url()->send('user.photo.process', $token);
            } elseif (isset($aImage['name']) && !empty($aImage['name'])) {
				$iUserId = Phpfox::getUserId();
				if (isset($aVals['is_iframe']) && Phpfox::isAdmin())
				{
					$iUserId = (int) $aVals['user_id'];	
				}
				
				if (($aImage = User_Service_Process::instance()->uploadImage($iUserId, true)) !== false)
				{				
					if (isset($aVals['is_iframe']))
					{
						$sImage = Phpfox::getLib('image.helper')->display(array(
								'server_id' => $aImage['server_id'],
								'path' => 'core.url_user',
								'file' => $aImage['user_image'],
								'suffix' => '_50_square',
								'max_width' => 50,
								'max_height' => 50,
								'thickbox' => true,
								'time_stamp' => true								
							)
						);
						
						echo "<script type=\"text/javascript\">window.parent.document.getElementById('js_user_photo_" . $iUserId . "').innerHTML = '{$sImage}'; window.parent.tb_remove(); window.parent.\$Core.loadInit();</script>";
						exit;
					}
					else 
					{
                        if (isset($_SERVER['HTTP_X_FILE_NAME'])) {
                            return [
                                'redirect' => $this->url()->makeUrl('profile')
                            ];
                        }
                        $this->url()->send('profile');
					}
				}			
			}
		}
		
		if (isset($aVals['is_iframe']))
		{
			exit;
		}
        $sFileName = base64_decode($this->request()->get('token'));
        if (empty($sFileName)){
            $sFileName = Phpfox::getUserBy('user_image');
        }
		$sImage = Phpfox_Image_Helper::instance()->display(array(
				'server_id' => Phpfox::getUserBy('server_id'),
				'title' => Phpfox::getUserBy('full_name'),
				'path' => 'core.url_user',
				'file' => $sFileName,
				'suffix' => '',
				'no_default' => true,
				'time_stamp' => true,
				'id' => 'user_profile_photo',				
				'class' => 'border',
				'return_url' => true,
			)
		);

		if ( !empty($sImage))
		{
			list($newHeight, $newWidth) = getimagesize($sImage);
			$this->template()->assign(array(
						'iImageHeight' => $newHeight,
						'iImageWidth' => $newWidth
					)
				);
		}
		
		$sPageTitle = ($bIsRegistration ? _p('upload_profile_picture') : _p('edit_profile_picture'));
		(($sPlugin = Phpfox_Plugin::get('user.component_controller_photo_3')) ? eval($sPlugin) : false);
		$this->template()->setTitle($sPageTitle)
			->setBreadCrumb($sPageTitle)
			->setFullSite()
			->setPhrase(array(
					'select_a_file_to_upload'
				)
			)				
			->setHeader(array(
					'jquery.cropit.js' => 'module_user',
                    'progress.js' => 'static_script',
					'<script type="text/javascript">$Behavior.changeUserPhoto = function(){ if ($Core.exists(\'#js_photo_form_holder\')) { oProgressBar = {holder: \'#js_photo_form_holder\', progress_id: \'#js_progress_bar\', uploader: \'#js_progress_uploader\', add_more: false, max_upload: 1, total: 1, frame_id: \'js_upload_frame\', file_id: \'image\'}; $Core.progressBarInit(); } }</script>'					
                )
			)
			->assign(array(
					'sProfileImage' => $sImage,
					'bIsRegistration' => $bIsRegistration,
					'sNextUrl' => $this->url()->makeUrl($sNextUrl),
                    'iMinWidth' => 248,
					'bIsProcess' => $bIsProcess,
					'iMaxFileSize' => (Phpfox::getUserParam('user.max_upload_size_profile_photo') === 0 ? null : ((Phpfox::getUserParam('user.max_upload_size_profile_photo') / 1024) * 1048576))
				)
			);
        return null;
	}
}