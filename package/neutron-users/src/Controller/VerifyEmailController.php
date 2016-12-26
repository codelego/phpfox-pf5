<?php
namespace Neutron\User\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class VerifyEmailController extends ActionController
{
    /**
     * This action process user verify email action by a token send via email
     * address.
     *
     * @return false|ViewModel
     */
    public function actionIndex()
    {
        $request = \Phpfox::get('mvc.request');
        $tokenId = $request->getParam('token', null);

        $verifyService = \Phpfox::get('user.verify_email');
        $browseService = \Phpfox::get('user.browse');

        $token = $verifyService->findTokenById($tokenId);


        if (!$token) { // token invalid ?
            return $this->forward(null, 'resend');
        }

        if ($token['expires_at'] < time()) { // is token expired ?
            return $this->forward(null, 'resend');
        }

        // validate user exists
        $user = $browseService->findUserById($token['user_id']);

        if (!$user) {

        }

        if (!$user['is_verified']) { // is user verified

        }

        return null;
    }
}