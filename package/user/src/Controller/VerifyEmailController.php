<?php
namespace Neutron\User\Controller;

use Phpfox\Action\ActionController;

class VerifyEmailController extends ActionController
{
    public function actionIndex()
    {
        $request = \Phpfox::get('request');
        $tokenId = $request->get('token');

        $verifyService = \Phpfox::get('user.verify_email');
        $browseService = \Phpfox::get('user.browse');

        $token = $verifyService->findById($tokenId);

        if (!$token) { // invalid token
            return $this->forward(null, 'resend');
        }

        if ($token->getExpiresAt() < time()) { // is token expired ?
            return $this->forward(null, 'resend');
        }

        // validate user exists
        $user = $browseService->findUserById($token->getUserId());

        if (!$user) {

        }

        if (!$user['is_verified']) { // is user verified

        }

    }
}